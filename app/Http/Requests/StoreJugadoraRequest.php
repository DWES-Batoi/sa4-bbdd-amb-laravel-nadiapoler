<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJugadoraRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'equip_id' => 'nullable|exists:equips,id',
            'data_naixement' => 'required|date|before:-16 years',
            'dorsal' => 'required|integer|min:1',
            'foto' => 'nullable|image|mimes:png|max:2048',
        ];
    }
}
