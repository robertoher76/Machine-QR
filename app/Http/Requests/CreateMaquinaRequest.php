<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMaquinaRequest extends FormRequest
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
            'nombre_maquina' => 'required|max:50',
            'descripcion' => 'required|max:600',
            'foto_up' => 'required|mimes:jpg,jpeg,png|max:2500',            
        ];
    }

    public function messages()
    {
        return [
            'nombre_maquina.required' => 'El nombre de la máquina es requirido.',
            'descripcion.required' => 'La descripción de la máquina es requirido.',
            'nombre_maquina.max' => 'El nombre de la máquina no puede superar los 50 caracteres.',
            'descripcion.max' => 'La descripción no puede superar los 600 caracteres.',
            'foto_up.required' => 'La imagen de la máquina es requerido.',
            'foto_up.mimes' => 'La imagen debe ser un tipo de archivo: jpg, jpeg, png.',
            'foto_up.max' => 'La imagen no debe ser mayor a 2500 kilobytes.',
        ];
    }
}
