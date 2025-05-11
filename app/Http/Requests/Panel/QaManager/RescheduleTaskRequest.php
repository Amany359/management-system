<?php

namespace App\Http\Requests\Panel\QaManager;

use Illuminate\Foundation\Http\FormRequest;

class RescheduleTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'qa_manager';
    }

    public function rules(): array
    {
        return [
            'scheduled_at' => ['required', 'date', 'after:now'],
        ];
    }
}
