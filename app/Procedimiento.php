<?php

namespace App;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
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

    public static function setNumero_Orden($numero,$id)
    {
        if(self::getIsEmptyProcedimiento($numero,$id)){
            if(self::getLastProcedimiento($id) == 0 && $numero == 1){
                return true;
            }elseif (($numero - self::getLastProcedimiento($id)) == 1 ) {
                return true;
            }            
        }else{            
            self::getUpdateOrden($numero, $id);
            return true;
        }
        return false;
    }

    public static function getUpdateOrden($numero, $id){
        $i = self::getLastProcedimiento($id);        
        for($i; $i >= $numero; $i--){
            Procedimiento::where('instruccione_id','=',$id)
                         ->where('numero_orden',"=",$i)
                         ->update(['numero_orden' => $i+1]);
        }        
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
}
