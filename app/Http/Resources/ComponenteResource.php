<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ComponenteResource extends JsonResource
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
            'maquina_id' => $this->maquina_id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'imagen' => $request->root() . '/storage/imagenes/componentes/' . $this->imagen,
            'numero_orden' => $this->numero_orden,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
