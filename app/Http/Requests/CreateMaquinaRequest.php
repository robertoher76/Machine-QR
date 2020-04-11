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
            'nombre_maquina' => 'required|max:50|unique:maquinas,nombre_maquina',
            'descripcion' => 'required|max:1500',
            'foto_up' => 'required|mimes:jpg,jpeg,png|max:4000',
        ];
    }

    public function messages()
    {
        return [
            'nombre_maquina.required' => 'Ingrese el nombre de la máquina.',
            'nombre_maquina.unique' => 'El nombre ya ha sido registrado por otra máquina.',
            'descripcion.required' => 'Ingrese la descripción de la máquina.',
            'nombre_maquina.max' => 'El nombre de la máquina no puede superar los 50 caracteres.',
            'descripcion.max' => 'La descripción no puede superar los 1500 caracteres.',
            'foto_up.required' => 'Ingrese la imagen de la máquina.',
            'foto_up.mimes' => 'La imagen debe ser un tipo de archivo: jpg, jpeg, png.',
            'foto_up.max' => 'La imagen no debe ser mayor a 4000 kilobytes.',
        ];
    }
}
