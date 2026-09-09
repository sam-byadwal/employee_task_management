<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Http\Requests\StoreTaskCommentRequest;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::where('assigned_to', Auth::id())
            ->latest();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        $tasks = $query->get();

        return view('employee.auth.tasks.index', compact('tasks'));
    }

    

    public function show(Task $task)
    {
        abort_unless(
            $task->assigned_to === Auth::id(),
            403
        );

        $task->load('comments.user');

        return view('employee.auth.tasks.show', compact('task'));
    }

     public function updateStatus(UpdateTaskStatusRequest  $request, Task $task)
    {
       
$validated = $request->validated();

        $task->update([
            'status' => $validated['status'],
        ]);

        return back()->with(
            'success',
            'Task status updated successfully.'
        );
    }

    public function addComment(StoreTaskCommentRequest $request, Task $task)
    {
       $validated = $request->validated();


        Comment::create([
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'comment' => $validated['comment'],
        ]);

        return back()->with(
            'success',
            'Comment added successfully.'
        );
    }
}