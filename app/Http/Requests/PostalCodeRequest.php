<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostalCodeRequest extends FormRequest
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
            'slug' => 'nullable|string|max:255|unique:cities,slug,' . $this->route('postal-code'),
            'status' => 'nullable|boolean',
        ];
    }

    /**
     * Custom messages (optional)
     */
    public function messages(): array
    {
        return [
            'title.required' => 'City title is required.',
        ];
    }
}
