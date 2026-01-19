<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePartitRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'local_id' => 'required|exists:equips,id',
            'visitant_id' => 'required|exists:equips,id|different:local_id',
            'estadi_id' => 'required|exists:estadis,id',
            'data' => 'required|date',
            'jornada' => 'required|integer|min:1',
            'gols_local' => 'nullable|integer|min:0',
            'gols_visitant' => 'nullable|integer|min:0',
        ];
    }
}
