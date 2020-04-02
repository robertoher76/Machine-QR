<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProcedimientoRequest extends FormRequest
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
            'foto_up' => 'required|mimes:jpg,jpeg,png|max:2500',
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
            'foto_up.required' => 'La imagen del procedimiento es requerido.',
            'foto_up.mimes' => 'La imagen debe ser un tipo de archivo: jpg, jpeg, png.',
            'foto_up.max' => 'La imagen no debe ser mayor a 2500 kilobytes.',
        ];
    }
}
