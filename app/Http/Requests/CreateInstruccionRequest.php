<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateInstruccionRequest extends FormRequest
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
            'titulo' => 'required|max:50|unique:instrucciones,titulo',
            'descripcion' => 'required|max:1500',
            'instrucciones_tipo_id' => 'required|numeric',
            'numero_orden' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => 'El título de la instrucción es requirido.',
            'titulo.max' => 'El título no puede superar los 50 caracteres.',
            'titulo.unique' => 'El título ya ha sido registrado en la base de datos.',
            'numero_orden.required' => 'La posición de la instrucción es requerido.',
            'descripcion.required' => 'La descripción de la instrucción es requirido.',
            'numero_orden.numeric' => 'La posición debe ser un número.',
            'descripcion.max' => 'La descripción no puede superar los 1500 caracteres.',
            'instrucciones_tipo_id.numeric' => 'El tipo de instrucción debe ser un número.',
        ];
    }
}
