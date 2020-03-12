<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instrucciones_tipo extends Model
{
    public function instrucciones(){

        return $this->hasMany('App\Instruccione');

    }
}
