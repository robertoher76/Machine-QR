<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Tutoriale extends Model
{
    protected $fillable = ['maquina_id','titulo','descripcion','video','numero_orden'];

    public static function setTutorialMaquina($video, $actual = false){
        if($video){
            if($actual){
                Storage::disk('public')->delete("tutoriales/$actual");
            }
            $videoName = $video->getClientOriginalName();          
            Storage::disk('public')->put("tutoriales", $video);

            return $videoName;
        }else{
            return false;
        }
    }
}
