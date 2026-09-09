<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_employee_cannot_view_another_employees_task(): void
    {
        $employeeA = User::factory()->create([
            'role' => 'employee',
            'status' => true,
        ]);

        $employeeB = User::factory()->create([
            'role' => 'employee',
            'status' => true,
        ]);

        $task = Task::create([
            'title' => 'Employee A Task',
            'description' => 'Private task for Employee A.',
            'assigned_to' => $employeeA->id,
            'created_by' => null,
            'priority' => 'medium',
            'status' => 'pending',
            'due_date' => now()->addDays(2),
        ]);

        $response = $this
            ->actingAs($employeeB)
            ->get(route('employee.tasks.show', $task));

        $response->assertForbidden();
    }
}