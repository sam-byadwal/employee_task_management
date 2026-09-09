<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_inactive_employee_cannot_login(): void
    {
        $employee = User::factory()->create([
            'role' => 'employee',
            'status' => false,
            'password' => 'password',
        ]);

        $response = $this->post(route('employee.login.submit'), [
            'email' => $employee->email,
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors('email');

        $this->assertGuest();
    }
}