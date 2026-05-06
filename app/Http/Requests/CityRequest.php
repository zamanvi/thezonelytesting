<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'title'    => 'required|string|max:255',
            'slug'     => 'nullable|string|max:255',
            'state_id' => 'nullable|exists:states,id',
            'status'   => 'nullable|boolean',
        ];
    }
}
