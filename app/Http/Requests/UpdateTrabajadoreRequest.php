<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTrabajadoreRequest extends FormRequest
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
            //trabajador
            'nombre' =>'required' ,
            'apellido' =>'required',
            //user
            'email' =>'required',
            'password' => 'nullable|string|min:8|confirmed', 
            //area
            'area' =>'required',
            //rol
            'rol' =>'required',
        ];
    }
}
