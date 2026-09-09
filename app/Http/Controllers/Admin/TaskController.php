<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
class TaskController extends Controller
{


      

    public function index(Request $request)
{
    $query = Task::with('employee')
        ->latest();

    // Search by task title, description, or employee name
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhereHas('employee', function ($employeeQuery) use ($search) {
                    $employeeQuery->where(
                        'name',
                        'like',
                        "%{$search}%"
                    );
                });
        });
    }

    // Filter by status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Filter by priority
    if ($request->filled('priority')) {
        $query->where('priority', $request->priority);
    }

    // Pagination
    $tasks = $query
        ->paginate(2)
        ->withQueryString();

    return view('admin.tasks.index', compact('tasks'));
}
    public function show(Task $task)
{
    

     $task->load([
        'employee',
        'creator', // created by 
        'comments.user',
    ]);

   

    return view('admin.tasks.show', compact('task'));
}
    public function create()
    {
        $employees = User::where('role', 'employee')
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view('admin.tasks.create', compact('employees'));
    }

    public function store(StoreTaskRequest  $request)
    {
        // $validated = $request->validate([
        //     'title' => ['required', 'string', 'max:255'],
        //     'description' => ['nullable', 'string'],
        //     // 'assigned_to' => ['nullable', 'exists:users,id'],
        //         'assigned_to' => [
        //     'nullable',
        //     Rule::exists('users', 'id')
        //         ->where(function ($query) {
        //             $query->where('role', 'employee')
        //                   ->where('status', true);
        //         }),
        // ],


        
        //     'priority' => ['required', 'in:low,medium,high,urgent'],
        //     'status' => ['required', 'in:pending,in_progress,completed'],
        //     'due_date' => ['nullable', 'date'],
        // ]);


        $validated = $request->validated();

        Task::create([
    ...$validated,
    'created_by' => auth()->id(),
]);
        


        return redirect()
            ->route('admin.tasks.index')
            ->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        $employees = User::where('role', 'employee')
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view('admin.tasks.edit', compact('task', 'employees'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $validated = $request->validated();
        $task->update($validated);

        return redirect()
            ->route('admin.tasks.index')
            ->with('success', 'Task updated successfully.');
    }



public function destroy(Task $task)
{
    // Delete all comments related to this task
    $task->comments()->delete();

    // Delete the task
    $task->delete();

    return redirect()
        ->route('admin.tasks.index')
        ->with('success', 'Task deleted successfully.');
}
}