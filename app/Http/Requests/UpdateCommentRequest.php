<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'task_id' => [
                'required',
                'exists:tasks,id',
            ],

            'comment' => [
                'required',
                'string',
                'max:5000',
            ],
        ];
    }
}