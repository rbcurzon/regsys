<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255', 'alpha:ascii'],
            'last_name' => ['required', 'string', 'max:255', 'alpha:ascii'],
            'year_level' => ['required', 'numeric'],
            'course_id' => ['required', 'gte:0'], //gte = greater that or equal
            'section' => ['required'],

        ];
    }
}
