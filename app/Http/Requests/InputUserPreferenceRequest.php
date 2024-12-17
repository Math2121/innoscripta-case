<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InputUserPreferenceRequest extends FormRequest
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
            'preferred_sources' => ["required", "array"],
            'preferred_sources.*' => ["required", "string", "distinct"],
            'preferred_categories' => ["required", "array"],
            'preferred_categories.*' => ["required", "string", "distinct"],
            'preferred_authors' => ["required", "array"],
            'preferred_authors.*' => ["required", "string", "distinct"],

        ];
    }
}
