<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Employee statistics
        $totalEmployees = User::where('role', 'employee')->count();

        $activeEmployees = User::where('role', 'employee')
            ->where('status', true)
            ->count();

        $inactiveEmployees = User::where('role', 'employee')
            ->where('status', false)
            ->count();


        // Task statistics
        $totalTasks = Task::count();

        $pendingTasks = Task::where('status', 'pending')->count();

        $inProgressTasks = Task::where('status', 'in_progress')->count();

        $completedTasks = Task::where('status', 'completed')->count();
        $overdueTasks = Task::where('status', '!=', 'completed')
    ->whereNotNull('due_date')
    ->whereDate('due_date', '<', today())
    ->count();

        // $urgentTasks = Task::where('priority', 'urgent')->count();


        return view('admin.auth.dashboard', compact(
            'totalEmployees',
            'activeEmployees',
            'inactiveEmployees',
            'totalTasks',
            'pendingTasks',
            'inProgressTasks',
            'completedTasks',
            // 'urgentTasks',
            'overdueTasks'
        ));
    }
}
