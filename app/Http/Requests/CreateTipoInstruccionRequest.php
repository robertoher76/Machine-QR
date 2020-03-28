<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTipoInstruccionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required|max:50',
            'descripcion_tipo' => 'required|max:600',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Ingrese el nombre del tipo de instrucción.',
            'descripcion_tipo.required' => 'Ingrese la descripción.',
            'nombre.max' => 'El nombre no puede superar los 50 caracteres.',
            'descripcion_tipo.max' => 'La descripción no puede superar los 1500 caracteres.',            
        ];
    }
}
