<?php

namespace App\Http\Requests\Panel\Programmer;

use Illuminate\Foundation\Http\FormRequest;

class UpdatTaskProgrammerStatusRequest extends FormRequest
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
            'status' => 'required|string|in:approved,in_progress,done,in_testing,tested_done,needs_fix',
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'يرجى تحديد الحالة الجديدة.',
            'status.in' => 'الحالة المحددة غير صالحة.',
        ];
    }
}
