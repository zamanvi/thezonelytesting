<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StateRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'title'      => 'required|string|max:255',
            'slug'       => 'nullable|string|max:255',
            'country_id' => 'nullable|exists:countries,id',
            'status'     => 'nullable|boolean',
        ];
    }
}
