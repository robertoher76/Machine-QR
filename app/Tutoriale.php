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

    public static function getTutoriales($maquina_id){
        try{
            return Tutoriale::where('maquina_id','=',$maquina_id)->orderBy('numero_orden')->get();
        }catch(\Exception $ex){
            return null;
        }
    }

    public static function getTutorialesPaginate($maquina_id, $paginate = 15){
        try{
            $tutoriales = Tutoriale::where('maquina_id','=',$maquina_id)->orderBy('numero_orden')->paginate($paginate);
            return Maquina::cortarParrafos($tutoriales,100);
        }catch(\Exception $ex){
            return null;
        }
    }

    public static function deleteTutorial($videoActual){
        try{
            Storage::disk('public')->delete("tutoriales/$videoActual");
            return true;
        }catch(\Exception $ex){
            return false;
        }
    }

    public static function setNumeroOrdenCreate($maquina_id, $posicion){
        try{
            if(self::getLastTutorial($maquina_id)+1 == $posicion){
                return true;
            }else{
                if(self::updateOrdenIncrease($maquina_id, $posicion))
                    return true;
            }
            return false;
        }catch(QueryException $ex){
            return false;
        }
    }

    public static function setNumeroOrdenEdit($maquina_id, $posicion, $posicionActual){
        try{
            if($posicionActual > $posicion){
                if(self::updateOrdenIncrease($maquina_id, $posicion, $posicionActual))
                    return true;
            }elseif($posicionActual < $posicion){
                if(self::updateOrdenDecrease($maquina_id, $posicion, $posicionActual))
                    return true;
            }
            return true;
        }catch(QueryException $ex){
            return false;
        }
    }

    public static function getLastTutorial($maquina_id){
        try{
            return Tutoriale::where('maquina_id','=',$maquina_id)
                            ->count();
        }catch(QueryException $ex){
            return null;
        }
    }

    public static function updateOrdenIncrease($maquina_id, $posicion, $posicionActual = false){
        try{
            if($posicionActual == false){
                $i = self::getLastTutorial($maquina_id);
                for($i;$i >= $posicion; $i--){
                    Tutoriale::where('maquina_id','=',$maquina_id)
                             ->where('numero_orden','=',$i)
                             ->update(['numero_orden' => $i+1]);
                }
            }else{
                $i = $posicionActual-1;
                for($i;$i >= $posicion; $i--){
                    Tutoriale::where('maquina_id','=',$maquina_id)
                             ->where('numero_orden','=',$i)
                             ->update(['numero_orden' => $i+1]);
                }
            }
            return true;
        }catch(QueryException $ex){
            return false;
        }
    }

    public static function updateOrdenDecrease($maquina_id, $posicion = false, $posicionActual){
        try{
            if($posicion){
                $i = $posicionActual+1;
                for($i;$i <= $posicion; $i++){
                    Tutoriale::where('maquina_id','=',$maquina_id)
                                ->where('numero_orden','=',$i)
                                ->update(['numero_orden' => $i-1]);
                }
            }else{
                $i=$posicionActual+1;
                for($i;$i <= self::getLastTutorial($maquina_id); $i++){
                    Tutoriale::where('maquina_id','=',$maquina_id)
                             ->where('numero_orden','=',$i)
                             ->update(['numero_orden' => $i-1]);
                }
            }
            return true;
        }catch(QueryException $ex){
            return false;
        }
    }
}
