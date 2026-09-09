<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_employee_cannot_access_admin_dashboard(): void
    {
        $employee = User::factory()->create([
            'role' => 'employee',
            'status' => true,
        ]);

        $response = $this
            ->actingAs($employee)
            ->get(route('admin.dashboard'));

        $response->assertForbidden();
    }
}