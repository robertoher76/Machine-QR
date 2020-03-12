<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maquina extends Model
{
    //
    public function maquina_imagenes(){
        
        return $this->hasMany('App\Maquina_imagene');
    }

    public function componentes(){

        return $this->hasMany('App\Componente');

    }

    public function instrucciones(){

        return $this->hasMany('App\Instruccione');

    }

    public function tutoriales(){

        return $this->hasMany('App\Tutoriale');

    }

}
