<?php

namespace App\Http\Requests\Panel\TeamLeader;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'programmer_id' => 'required|exists:users,id',
            'tester_id' => 'nullable|exists:users,id',
            'status' => 'required|in:proposed,approved,in_progress,done,in_testing,tested_done,needs_fix',
            'priority' => 'required|in:low,medium,high',
            'scheduled_for_date' => 'nullable|date',
            'original_scheduled_date' => 'nullable|date|before_or_equal:scheduled_for_date',
        ];
    }
}
