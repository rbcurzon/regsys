<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    public function messages()
{
    return [
        'status.declined_if' => 'Status cannot be released when is not paid'
    ];
}

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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'student_id' => 'required',
            'needed_date' => 'required|after:today',
            'purpose_id' => 'required | gte:0',
            'document_id' => 'required | gte:0',
            'status' => $this->status === 'released' ? 'declined_if:is_paid,0' : '',
        ];
    }
}
