<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEstadiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom'       => 'required|min:3',
            'capacitat' => 'required|integer|min:1',
        ];
    }
}
