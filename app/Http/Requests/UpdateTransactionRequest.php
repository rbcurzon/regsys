<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends FormRequest
{
    public function messages()
    {
        return [
            'status.declined_if' => 'The payment must be made.',
            'needed_date.before' => 'The needed date must be within the next 7 days.',
            'needed_date.required' => 'The needed date is required.',
            'purpose_id.gte' => 'The purpose is required.',
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
//        dd($this->request->all());
        return [
            'needed_date' => 'required|after:today | before:today + 7 days',
            'purpose_id' => 'required | gte:0',
            'status' => $this->status !== 'pending' ? 'declined_if:is_paid,0' : '',
        ];
    }
}
