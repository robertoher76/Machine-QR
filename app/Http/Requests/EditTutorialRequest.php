<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditTutorialRequest extends FormRequest
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
            'titulo' => 'required|max:50',
            'descripcion' => 'required|max:1500',
            'numero_orden' => 'required'            
        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => 'Ingrese el título.',
            'numero_orden.required' => 'La posición es obligatoría.',
            'descripcion.required' => 'Ingrese la descripción.',
            'titulo.max' => 'El título no puede superar los 50 caracteres.',
            'descripcion.max' => 'La descripción no puede superar los 1500 caracteres.',  

        ];
    }
}
