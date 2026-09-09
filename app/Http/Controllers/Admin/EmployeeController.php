<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
   
public function index(Request $request)
{
    $query = User::where('role', 'employee');

    // Search by employee name or email
    if ($request->filled('search')) {

        $search = $request->search;

        $query->where(function ($q) use ($search) {

            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");

        });
    }

    // Overall employee statistics
    $totalEmployees = User::where('role', 'employee')
        ->count();

    $activeEmployees = User::where('role', 'employee')
        ->where('status', true)
        ->count();

    $inactiveEmployees = User::where('role', 'employee')
        ->where('status', false)
        ->count();

    // Paginated employee list
    $employees = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view('admin.employees.index', compact(
        'employees',
        'totalEmployees',
        'activeEmployees',
        'inactiveEmployees'
    ));
}

    public function create()
    {
        return view('admin.employees.create');
    }

    // public function store(Request $request)

    public function store(StoreEmployeeRequest $request)
    {
        

        $validated = $request->validated();
      

           User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => $validated['password'],
        'role' => 'employee',
        'status' => $validated['status'],
    ]);


    
        return redirect()
            ->route('admin.employees.index')
            ->with('success', 'Employee added successfully.');
    }

    // public function edit(User $employee)
    // {
    //     return view('admin.employees.edit', compact('employee'));
    // }

    public function edit(User $employee)
{
    abort_unless($employee->role === 'employee', 404);

    return view('admin.employees.edit', compact('employee'));
}

    public function update(UpdateEmployeeRequest $request,User $employee
) {
    abort_unless($employee->role === 'employee', 404);

    $validated = $request->validated();

    $employee->name = $validated['name'];
    $employee->email = $validated['email'];
    $employee->status = $validated['status'];

    if (!empty($validated['password'])) {
        $employee->password = $validated['password'];
    }

    $employee->save();

    return redirect()
        ->route('admin.employees.index')
        ->with('success', 'Employee updated successfully.');
}
    public function destroy(User $employee)
{
    abort_unless($employee->role === 'employee', 404);


    
    if ($employee->tasks()->exists()) { // check by this employe have any task or not 
        return redirect()
            ->route('admin.employees.index')
            ->with(
                'error',
                'This employee cannot be deleted because tasks are assigned to them. Reassign the tasks first.'
            );
    }

    $employee->delete();

    return redirect()
        ->route('admin.employees.index')
        ->with('success', 'Employee deleted successfully.');
}



    public function toggleStatus(User $employee)
    {

     abort_unless($employee->role === 'employee', 404);
        $employee->update([
            'status' => !$employee->status,
        ]);

        return redirect()
            ->route('admin.employees.index')
            ->with('success', 'Employee status updated.');
    }


public function tasks(User $employee)
{
    abort_unless($employee->role === 'employee', 404);

    $tasks = $employee->tasks()
        ->with('creator')
        ->latest()
        ->paginate(10);

    $availableEmployees = User::where('role', 'employee')
        ->where('status', true)
        ->where('id', '!=', $employee->id)
        ->orderBy('name')
        ->get();

    return view('admin.employees.tasks', compact(
        'employee',
        'tasks',
        'availableEmployees'
    ));
}

public function reassignTask(Request $request, User $employee, Task $task)
{
    abort_unless($employee->role === 'employee', 404);

    $request->validate([
        'assigned_to' => [
            'required',
            'exists:users,id',
        ],
    ]);

    // Make sure this task actually belongs to this employee
    abort_unless($task->assigned_to === $employee->id, 404);

    $newEmployee = User::where('id', $request->assigned_to)
        ->where('role', 'employee')
        ->where('status', true)
        ->firstOrFail();

    $task->update([
        'assigned_to' => $newEmployee->id,
    ]);

    return redirect()
        ->route('admin.employees.tasks', $employee)
        ->with('success', 'Task reassigned successfully.');
}

public function bulkReassignTasks(
    Request $request,
    User $employee
) {
    abort_unless($employee->role === 'employee', 404);

    $validated = $request->validate([
        'task_ids' => ['required', 'array', 'min:1'],
        'task_ids.*' => ['integer', 'exists:tasks,id'],
        'assigned_to' => ['required', 'exists:users,id'],
    ]);

    $newEmployee = User::where('id', $validated['assigned_to'])
        ->where('role', 'employee')
        ->where('status', true)
        ->firstOrFail();

    $taskIds = Task::whereIn('id', $validated['task_ids'])
        ->where('assigned_to', $employee->id)
        ->pluck('id');

    if ($taskIds->count() !== count(array_unique($validated['task_ids']))) {
        abort(404);
    }

    $updated = Task::whereIn('id', $taskIds)
        ->update([
            'assigned_to' => $newEmployee->id,
        ]);

    return redirect()
        ->route('admin.employees.tasks', $employee)
        ->with(
            'success',
            "{$updated} task(s) reassigned successfully."
        );
}
}