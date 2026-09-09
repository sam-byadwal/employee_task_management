<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OverdueTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_pending_overdue_task_is_counted_as_overdue(): void
    {
        $employee = User::factory()->create([
            'role' => 'employee',
            'status' => true,
        ]);

        $task = Task::create([
            'title' => 'Overdue Task',
            'description' => 'This task is overdue.',
            'assigned_to' => $employee->id,
            'created_by' => null,
            'priority' => 'high',
            'status' => 'pending',
            'due_date' => now()->subDay(),
        ]);

        $overdueCount = Task::where('status', '!=', 'completed')
            ->whereNotNull('due_date')
            ->whereDate('due_date', '<', today())
            ->count();

        $this->assertSame(1, $overdueCount);

        $task->update([
            'status' => 'completed',
        ]);

        $overdueCount = Task::where('status', '!=', 'completed')
            ->whereNotNull('due_date')
            ->whereDate('due_date', '<', today())
            ->count();

        $this->assertSame(0, $overdueCount);
    }
}