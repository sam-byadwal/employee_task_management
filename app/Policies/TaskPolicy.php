<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function view(User $user, Task $task): bool
    {
        return $user->role === 'admin'
            || $task->assigned_to === $user->id;
    }

    public function updateStatus(User $user, Task $task): bool
    {
        return $user->role === 'employee'
            && $task->assigned_to === $user->id;
    }

    public function comment(User $user, Task $task): bool
    {
        return $user->role === 'admin'
            || $task->assigned_to === $user->id;
    }
}