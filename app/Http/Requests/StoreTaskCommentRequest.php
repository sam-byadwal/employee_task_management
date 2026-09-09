<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        $task = $this->route('task');

        return $task
            && $this->user()?->can('comment', $task);
    }

    public function rules(): array
    {
        return [
            'comment' => [
                'required',
                'string',
                'max:5000',
            ],
        ];
    }
}