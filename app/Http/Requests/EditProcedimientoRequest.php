<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProcedimientoRequest extends FormRequest
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
            'descripcion' => 'required|max:1500',
            'numero_orden' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'numero_orden.required' => 'La posición del procedimiento es requerido.',
            'descripcion.required' => 'La descripción del procedimiento es requirido.',
            'numero_orden.numeric' => 'La posición del procedimiento debe ser un número.',
            'descripcion.max' => 'La descripción no puede superar los 1500 caracteres.',
        ];
    }
}
