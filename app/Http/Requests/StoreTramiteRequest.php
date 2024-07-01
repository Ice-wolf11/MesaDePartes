<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTramiteRequest extends FormRequest
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
            //remitente
            'nombre' => 'required|max:80',
            'tipoPersona' => 'required|max:80',
            'dniRuc' => 'required|max:11', 
            'email' => 'required|max:255',
            'telefono' => 'nullable|max:10',
            //documento
            'tipoDocumento' => 'required|max:20',
            'otroTipoDocumento' => 'nullable|max:20',
            'cantidadFolios' => 'required|max:2',
            'asunto' => 'required|max:255',
            'adjuntarArchivo' => 'required|max:255',//recuerda cambiar esto
        ];
    }
}
