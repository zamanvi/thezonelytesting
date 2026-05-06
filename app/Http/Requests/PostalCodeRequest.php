<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostalCodeRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'title'   => 'required|string|max:20',
            'slug'    => 'nullable|string|max:255',
            'city_id' => 'nullable|exists:cities,id',
            'status'  => 'nullable|boolean',
        ];
    }
}
