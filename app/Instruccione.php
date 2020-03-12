<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instruccione extends Model
{
    public function procedimientos(){

        return $this->hasMany('App\Procedimiento');

    }
}
