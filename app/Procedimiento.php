<?php

namespace App;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

class Procedimiento extends Model
{
    protected $fillable = ['instruccione_id','descripcion','numero_orden','imagen'];

    public static function setImagenProcedimiento($foto, $actual = false){
        if($foto){
            if($actual){
                Storage::disk('public')->delete("imagenes/procedimientos/$actual");
            }
            $imagenName = Str::random(20) . '.jpg';
            $imagen = Image::make($foto)->encode('jpg',90);
            Storage::disk('public')->put("imagenes/procedimientos/$imagenName", $imagen->stream());

            return $imagenName;
        }else{
            return false;
        }
    }

    public static function setDeleteImagenProcedimiento($foto_actual){
        if($foto_actual){
            Storage::disk('public')->delete("imagenes/procedimientos/$actual");
        }
    }

    public static function setNumeroOrdenCreate($instruccione_id, $posicion){
        try{
            if(self::getLastProcedimiento($instruccione_id)+1 == $posicion){
                return true;
            }else{
                if(self::updateOrdenIncrease($instruccione_id, $posicion))
                    return true;
            }
            return false;
        }catch(QueryException $ex){
            return false;
        }
    }

    public static function setNumeroOrdenEdit($instruccione_id, $posicion, $posicionActual){
        try{
            if($posicionActual > $posicion){
                if(self::updateOrdenIncrease($instruccione_id, $posicion, $posicionActual))
                    return true;
            }elseif($posicionActual < $posicion){
                if(self::updateOrdenDecrease($instruccione_id, $posicion, $posicionActual))
                    return true;
            }
            return true;
        }catch(QueryException $ex){
            return false;
        }
    }

    public static function updateOrdenIncrease($instruccione_id, $posicion, $posicionActual = false){
        try{
            if($posicionActual == false){
                $i = self::getLastProcedimiento($instruccione_id);
                for($i;$i >= $posicion; $i--){
                    Procedimiento::where('instruccione_id','=',$instruccione_id)
                                 ->where('numero_orden','=',$i)
                                 ->update(['numero_orden' => $i+1]);
                }
            }else{
                $i = $posicionActual-1;
                for($i;$i >= $posicion; $i--){
                    Procedimiento::where('instruccione_id','=',$instruccione_id)
                                 ->where('numero_orden','=',$i)
                                 ->update(['numero_orden' => $i+1]);
                }
            }
            return true;
        }catch(QueryException $ex){
            return false;
        }
    }

    public static function updateOrdenDecrease($instruccione_id, $posicion = false, $posicionActual){
        try{
            if($posicion){
                $i = $posicionActual+1;
                for($i;$i <= $posicion; $i++){
                    Procedimiento::where('instruccione_id','=',$instruccione_id)
                                ->where('numero_orden','=',$i)
                                ->update(['numero_orden' => $i-1]);
                }
            }else{
                $i=$posicionActual+1;
                for($i;$i <= self::getLastProcedimiento($instruccione_id); $i++){
                    Procedimiento::where('instruccione_id','=',$instruccione_id)
                                ->where('numero_orden','=',$i)
                                ->update(['numero_orden' => $i-1]);
                }
            }
            return true;
        }catch(QueryException $ex){
            return false;
        }
    }

    public static function getLastProcedimiento($instruccione_id){
        try{
            return Procedimiento::where('instruccione_id','=',$instruccione_id)
                                ->count();
        }catch(QueryException $ex){
            return null;
        }
    }

    public static function getListProcedimiento($instruccione_id){
        try{
            return Procedimiento::where('instruccione_id','=',$instruccione_id)
                                ->orderBy('numero_orden')
                                ->get();
        }catch(QueryException $ex){
            return null;
        }
    }
}
