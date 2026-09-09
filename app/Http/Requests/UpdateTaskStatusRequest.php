<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        $task = $this->route('task');

        return $task
            && $this->user()?->can('updateStatus', $task);
    }

    public function rules(): array
    {
        return [
            'status' => [
                'required',
                'in:pending,in_progress,completed',

                function ($attribute, $value, $fail) {

                    $currentStatus = $this->route('task')->status;

                    $allowedStatuses = match ($currentStatus) {

                        'pending' => [
                            'pending',
                            'in_progress',
                        ],

                        'in_progress' => [
                            'in_progress',
                            'completed',
                        ],

                        'completed' => [
                            'completed',
                        ],

                        default => [],
                    };

                    if (!in_array($value, $allowedStatuses, true)) {
                        $fail(
                            'Invalid status transition. Task status must move from Pending to In Progress to Completed.'
                        );
                    }
                },
            ],
        ];
    }
}