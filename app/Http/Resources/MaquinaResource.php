<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MaquinaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre_maquina,
            'descripcion' => $this->descripcion,
            'imagen' => $request->root() . '/storage/imagenes/maquinas/' . $this->imagen,
            'updated_at' => $this->updated_at,
        ];
    }
}
