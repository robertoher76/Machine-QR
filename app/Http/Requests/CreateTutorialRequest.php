<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTutorialRequest extends FormRequest
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
            'numero_orden' => 'required',
            'video_up' => 'required|mimes:mp4|max:500000',
        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => 'Ingrese el título.',
            'descripcion.required' => 'Ingrese la descripción.',
            'numero_orden.required' => 'La posición es obligatoría.',
            'titulo.max' => 'El título no puede superar los 50 caracteres.',
            'descripcion.max' => 'La descripción no puede superar los 1500 caracteres.',
            'video_up.required' => 'Ingrese el video tutorial.',
            'video_up.mimes' => 'El video debe ser un tipo de archivo: mp4.',
            'video_up.max' => 'El video no debe ser mayor a 500000 kilobytes.',
        ];
    }
}
