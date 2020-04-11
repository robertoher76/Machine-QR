<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateComponenteRequest extends FormRequest
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
            'nombre' => 'required|max:50|unique:componentes,nombre',
            'descripcion' => 'required|max:1500',
            'foto_up' => 'required|mimes:jpg,jpeg,png|max:4000',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del componente es requirido.',
            'nombre.unique' => 'El nombre del componente ya ha sido registrado.',
            'descripcion.required' => 'La descripción del componente es requirido.',
            'nombre.max' => 'El nombre del componente no puede superar los 50 caracteres.',
            'descripcion.max' => 'La descripción no puede superar los 1500 caracteres.',
            'foto_up.required' => 'La imagen del componente es requerido.',
            'foto_up.mimes' => 'La imagen debe ser un tipo de archivo: jpg, jpeg, png.',
            'foto_up.max' => 'La imagen no debe ser mayor a 4000 kilobytes.',
        ];
    }
}
