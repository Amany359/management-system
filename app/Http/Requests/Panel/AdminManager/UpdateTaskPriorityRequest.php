<?php

namespace App\Http\Requests\Panel\AdminManager;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskPriorityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'priority' => 'required|in:low,medium,high,critical'
        ];
    }
    }


