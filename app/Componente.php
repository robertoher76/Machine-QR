<?php

namespace App;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Maquina;

class Componente extends Model
{
    protected $fillable = ['maquina_id','nombre','descripcion','imagen','numero_orden'];

    public static function setImagenComponente($foto, $actual = false){
        if($foto){
            if($actual){
                Storage::disk('public')->delete("imagenes/componentes/$actual");
            }
            $imagenName = Str::random(20) . '.jpg';
            $imagen = Image::make($foto)->encode('jpg',90);
            Storage::disk('public')->put("imagenes/componentes/$imagenName", $imagen->stream());

            return $imagenName;
        }else{
            return false;
        }
    }

    public static function deleteImagenComponente($imagenActual){
        try{
            Storage::disk('public')->delete("imagenes/componentes/$imagenActual");
            return true;
        }catch(\Exception $ex){
            return false;
        }
    }

    public static function getComponentesPaginate($maquina_id, $paginate = 15){
        try{
            $componentes =  Componente::where("maquina_id","=",$maquina_id)->orderBy('numero_orden')->paginate($paginate);
            return Maquina::cortarParrafos($componentes,110);
        }catch(\Exception $ex){
            return null;
        }
    }

    public static function getComponentes($maquina_id){
        try{
            return Componente::where("maquina_id","=",$maquina_id)->orderBy('numero_orden')->get();
        }catch(\Exception $ex){
            return null;
        }
    }

    public static function setNumeroOrdenCreate($maquina_id, $posicion){
        try{
            if(self::getLastComponente($maquina_id)+1 == $posicion){
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

    public static function getLastComponente($maquina_id){
        try{
            return Componente::where('maquina_id','=',$maquina_id)
                             ->count();
        }catch(QueryException $ex){
            return null;
        }
    }

    public static function updateOrdenIncrease($maquina_id, $posicion, $posicionActual = false){
        try{
            if($posicionActual == false){
                $i = self::getLastComponente($maquina_id);
                for($i;$i >= $posicion; $i--){
                    Componente::where('maquina_id','=',$maquina_id)
                              ->where('numero_orden','=',$i)
                              ->update(['numero_orden' => $i+1]);
                }
            }else{
                $i = $posicionActual-1;
                for($i;$i >= $posicion; $i--){
                    Componente::where('maquina_id','=',$maquina_id)
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
                    Componente::where('maquina_id','=',$maquina_id)
                              ->where('numero_orden','=',$i)
                              ->update(['numero_orden' => $i-1]);
                }
            }else{
                $i=$posicionActual+1;
                for($i;$i <= self::getLastComponente($maquina_id); $i++){
                    Componente::where('maquina_id','=',$maquina_id)
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
