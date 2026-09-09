<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    public function index(Request $request)
    {
        $query = Comment::with(['task', 'user'])
            ->latest();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where('comment', 'like', "%{$search}%")
                ->orWhereHas('task', function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%");
                })
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
        }

        $comments = $query->get();

        return view('admin.comments.index', compact('comments'));
    }

    public function create()
    {
        $tasks = Task::with('employee')
            ->latest()
            ->get();

        return view('admin.comments.create', compact('tasks'));
    }

  public function store(StoreCommentRequest $request)
{
    $validated = $request->validated();

    Comment::create([
        'task_id' => $validated['task_id'],
        'user_id' => auth()->id(),
        'comment' => $validated['comment'],
    ]);

    return redirect()
        ->route('admin.comments.index')
        ->with('success', 'Comment added successfully.');
}
    public function edit(Comment $comment)
    {
        $comment->load(['task', 'user']);

        $tasks = Task::latest()->get();

        return view('admin.comments.edit', compact(
            'comment',
            'tasks'
        ));
    }

    public function update(UpdateCommentRequest  $request, Comment $comment)
    {
         $validated = $request->validated();
        $comment->update([
            'task_id' => $validated['task_id'],
            'comment' => $validated['comment'],
        ]);

        return redirect()
            ->route('admin.comments.index')
            ->with('success', 'Comment updated successfully.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()
            ->route('admin.comments.index')
            ->with('success', 'Comment deleted successfully.');
    }
}