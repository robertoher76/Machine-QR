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

    public static function getNumero_Orden($procedimiento_id){
        try {
            return Procedimiento::where('id','=',$procedimiento_id)->value('numero_orden');
        } catch (QueryException $ex) {
            return 0;
        }
    }

    public static function setNumero_Orden($numero,$id)
    {
        if(self::getIsEmptyProcedimiento($numero,$id)){
            if(self::getLastProcedimiento($id) == 0 && $numero == 1){
                return true;
            }elseif (($numero - self::getLastProcedimiento($id)) == 1 ) {
                return true;
            }
        }else{
            if(self::getUpdateOrden($numero, $id))
                return true;
        }
        return false;
    }

    public static function getUpdateOrden($numero, $id){
        try{
            $i = self::getLastProcedimiento($id);
            for($i; $i >= $numero; $i--){
                Procedimiento::where('instruccione_id','=',$id)
                            ->where('numero_orden',"=",$i)
                            ->update(['numero_orden' => $i+1]);
            }
            return true;
        }catch(QueryException $ex){
            return false;
        }
    }

    public static function getUpdateOrdenDelete($numero, $id){
        try{
            $i = $numero + 1;
            for($i; $i <= self::getLastProcedimiento($id); $i++){
                Procedimiento::where('instruccione_id','=',$id)
                            ->where('numero_orden',"=",$i)
                            ->update(['numero_orden' => $i-1]);
            }
            return true;
        }catch(QueryException $ex){
            return false;
        }
    }

    public static function getUpdateOrdenEdit($instruccione_id, $procedimiento_id, $posicionActual, $posicion){
        try {
            if($posicionActual > $posicion){
                $i = self::getLastProcedimiento($instruccione_id);
                for($i; $i >= $posicion; $i--){
                    if($posicionActual == $i)
                        continue;
                    Procedimiento::where('instruccione_id','=',$instruccione_id)
                                ->where('numero_orden',"=",$i)
                                ->update(['numero_orden' => $i+1]);
                }
                return true;
            }elseif($posicionActual < $posicion){
                $i = $posicionActual;
                for($i; $i <= $posicion; $i++){
                    if($posicionActual == $i)
                        continue;
                    Procedimiento::where('instruccione_id','=',$instruccione_id)
                                 ->where('numero_orden',"=",$i)
                                 ->update(['numero_orden' => $i-1]);
                }
                return true;
            }
            return true;
        }catch(QueryException $ex){
            return false;
        }
    }

    public static function setNumero_OrdenDelete($numero, $id){
        if(self::getLastProcedimiento($id) == $numero){
            return true;
        }else{
            if(self::getUpdateOrdenDelete($numero, $id))
                return true;
        }
        return false;
    }

    public static function getLastProcedimiento($id){
        $count = Procedimiento::where('instruccione_id','=',$id)
                            ->count();
        return $count;
    }

    public static function getIsEmptyProcedimiento($numero,$id){
        $dan = Procedimiento::where('instruccione_id','=',$id)
                            ->where('numero_orden',"=",$numero)
                            ->value('id');
        return ($dan) ? false : true;
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
