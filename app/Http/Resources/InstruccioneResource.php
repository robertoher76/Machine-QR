<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InstruccioneResource extends JsonResource
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
            'instrucciones_tipo_id' => $this->instrucciones_tipo_id,
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'numero_orden' => $this->numero_orden,
            'updated_at' => $this->updated_at,
        ];
    }
}
