<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instrucciones_tipo extends Model
{
    protected $fillable = ['nombre','descripcion_tipo'];

    public function instrucciones(){

        return $this->hasMany('App\Instruccione');

    }

}
