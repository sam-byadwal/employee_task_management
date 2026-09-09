<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class EmployeeDashboardController extends Controller
{
    public function index()
    {
        $employeeId = Auth::id();

        $totalTasks = Task::where('assigned_to', $employeeId)->count();

        $pendingTasks = Task::where('assigned_to', $employeeId)
            ->where('status', 'pending')
            ->count();

        $inProgressTasks = Task::where('assigned_to', $employeeId)
            ->where('status', 'in_progress')
            ->count();

        $completedTasks = Task::where('assigned_to', $employeeId)
            ->where('status', 'completed')
            ->count();

        $overdueTasks = Task::where('assigned_to', $employeeId)
            ->where('status', '!=', 'completed')
            ->whereNotNull('due_date')
            ->whereDate('due_date', '<', today())
            ->count();

        $tasks = Task::with('comments.user')
            ->where('assigned_to', $employeeId)
            ->latest()
            ->get();

        return view('employee.auth.dashboard', compact(
            'totalTasks',
            'pendingTasks',
            'inProgressTasks',
            'completedTasks',
            'overdueTasks',
            'tasks'
        ));
    }
}