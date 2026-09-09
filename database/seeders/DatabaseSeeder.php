<?php

namespace Database\Seeders;


use App\Models\Task;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Admin
        |--------------------------------------------------------------------------
        */

        $admin = User::updateOrCreate(
            [
                'email' => 'admin@example.com',
            ],
            [
                'name' => 'Admin',
                'password' => 'password',
                'role' => 'admin',
                'status' => true,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Employees
        |--------------------------------------------------------------------------
        */

        $employee1 = User::updateOrCreate(
            [
                'email' => 'employee1@example.com',
            ],
            [
                'name' => 'Employee One',
                'password' => 'password',
                'role' => 'employee',
                'status' => true,
            ]
        );

        $employee2 = User::updateOrCreate(
            [
                'email' => 'employee2@example.com',
            ],
            [
                'name' => 'Employee Two',
                'password' => 'password',
                'role' => 'employee',
                'status' => true,
            ]
        );


        

        $employee3 = User::updateOrCreate(
            [
                'email' => 'employee3@example.com',
            ],
            [
                'name' => 'Employee Three',
                'password' => 'password',
                'role' => 'employee',
                'status' => true,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Tasks
        |--------------------------------------------------------------------------
        */

        Task::create([
            'title' => 'Prepare monthly report',
            'description' => 'Prepare the monthly performance report.',
            'assigned_to' => $employee1->id,
            'created_by' => $admin->id,
            'priority' => 'high',
            'status' => 'pending',
            'due_date' => now()->addDays(2)->toDateString(),
        ]);

        Task::create([
            'title' => 'Update employee records',
            'description' => 'Review and update employee information.',
            'assigned_to' => $employee2->id,
            'created_by' => $admin->id,
            'priority' => 'medium',
            'status' => 'in_progress',
            'due_date' => now()->addDays(3)->toDateString(),
        ]);

        Task::create([
            'title' => 'Fix login issue',
            'description' => 'Investigate and fix the login issue.',
            'assigned_to' => $employee3->id,
            'created_by' => $admin->id,
            'priority' => 'high',
            'status' => 'completed',
            'due_date' => now()->subDays(2)->toDateString(),
        ]);

        Task::create([
            'title' => 'Database backup',
            'description' => 'Take a backup of the production database.',
            'assigned_to' => $employee1->id,
            'created_by' => $admin->id,
            'priority' => 'high',
            'status' => 'pending',
            'due_date' => now()->addDays(5)->toDateString(),
        ]);

        Task::create([
            'title' => 'Update website content',
            'description' => 'Update the website pages with new content.',
            'assigned_to' => $employee2->id,
            'created_by' => $admin->id,
            'priority' => 'low',
            'status' => 'pending',
            'due_date' => now()->addDays(7)->toDateString(),
        ]);

        Task::create([
            'title' => 'API documentation',
            'description' => 'Create documentation for the project APIs.',
            'assigned_to' => $employee3->id,
            'created_by' => $admin->id,
            'priority' => 'medium',
            'status' => 'in_progress',
            'due_date' => now()->addDays(4)->toDateString(),
        ]);

        Task::create([
            'title' => 'Fix dashboard bugs',
            'description' => 'Find and fix reported dashboard bugs.',
            'assigned_to' => $employee1->id,
            'created_by' => $admin->id,
            'priority' => 'high',
            'status' => 'pending',
            'due_date' => now()->subDays(1)->toDateString(),
        ]);

        Task::create([
            'title' => 'Code review',
            'description' => 'Review the latest code changes.',
            'assigned_to' => $employee2->id,
            'created_by' => $admin->id,
            'priority' => 'medium',
            'status' => 'completed',
            'due_date' => now()->subDays(3)->toDateString(),
        ]);

        Task::create([
            'title' => 'Testing new feature',
            'description' => 'Test the newly implemented feature.',
            'assigned_to' => $employee3->id,
            'created_by' => $admin->id,
            'priority' => 'high',
            'status' => 'in_progress',
            'due_date' => now()->addDays(1)->toDateString(),
        ]);

        Task::create([
            'title' => 'Prepare project documentation',
            'description' => 'Prepare complete project documentation.',
            'assigned_to' => $employee1->id,
            'created_by' => $admin->id,
            'priority' => 'low',
            'status' => 'pending',
            'due_date' => now()->addDays(10)->toDateString(),
        ]);
    }
}