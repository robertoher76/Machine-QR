<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Maquina;

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

    public static function getTutorialesPaginate($maquina_id, $paginate = 15){
        try{
            $tutoriales = Tutoriale::where('maquina_id','=',$maquina_id)->paginate($paginate);
            return Maquina::cortarParrafos($tutoriales,100);
        }catch(\Exception $ex){
            return null;
        }
    }
}
