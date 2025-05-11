<?php

namespace App\Http\Requests\Panel\QAManager;

use Illuminate\Foundation\Http\FormRequest;

class TaskFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'status' => 'nullable|in:pending,in_progress,completed,approved',
            'assigned_to' => 'nullable|exists:users,id',
        ];
    }
}
