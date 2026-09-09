<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'required',
                'string',
            ],

            'assigned_to' => [
                'required',
                Rule::exists('users', 'id')
                    ->where(function ($query) {
                        $query->where('role', 'employee')
                            ->where('status', true);
                    }),
            ],

            'priority' => [
                'required',
                'in:low,medium,high',
            ],

            'due_date' => [
                'required',
                'date',
            ],
        ];
    }
}