<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRevisioneRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'resolucion' => 'required',
            'respuesta' => 'required|max:255',
            'formFile'   => 'nullable|mimes:pdf|max:2048',
            'trabajador' => 'nullable',
            'trabajador_id' => 'required',
            'tramite_id' => 'required',
        ];
    }
}
