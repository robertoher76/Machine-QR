<?php

namespace App;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Maquina;

class Maquina_imagene extends Model
{
    protected $fillable = ['maquina_id','imagen','descripcion','numero_orden'];

    public static function setImagenGaleria($foto, $actual = false){
        if($foto){
            if($actual){
                Storage::disk('public')->delete("imagenes/galeria/$actual");
            }
            $imagenName = Str::random(20) . '.jpg';
            $imagen = Image::make($foto)->encode('jpg',90);
            Storage::disk('public')->put("imagenes/galeria/$imagenName", $imagen->stream());

            return $imagenName;
        }else{
            return false;
        }
    }

    public static function deleteImagenGaleria($actual){
        try{
            Storage::disk('public')->delete("imagenes/galeria/$actual");
            return true;
        }catch(\Exception $ex){
            return false;
        }
    }

    public static function getGaleria($maquina_id, $paginate = false){
        try{
            if($paginate){
                $galeria = Maquina_imagene::where('maquina_id','=',$maquina_id)
                                        ->orderBy('numero_orden')
                                        ->paginate($paginate);
                return Maquina::cortarParrafos($galeria, 150);
            }else{
                $galeria = Maquina_imagene::where('maquina_id','=',$maquina_id)
                                        ->orderBy('numero_orden')
                                        ->get();
                return Maquina::cortarParrafos($galeria, 150);
            }            
        }catch(\Exception $ex){
            return null;
        }
    }

    public static function setNumeroOrden($maquina_id){
        try{
            return Maquina_imagene::where('maquina_id','=',$maquina_id)->count() + 1;
        }catch(\Exception $ex){
            return false;
        }
    }

    public static function updateOrdenDecrease($maquina_id, $posicionActual){
        try{
            $i=$posicionActual+1;
            for($i;$i < self::setNumeroOrden($maquina_id); $i++){
                Maquina_imagene::where('maquina_id','=',$maquina_id)
                               ->where('numero_orden','=',$i)
                               ->update(['numero_orden' => $i-1]);
            }        
            return true;
        }catch(QueryException $ex){
            return false;
        }
    }

    public static function verificarImagenMaquina($maquina_id, $id){
        try{
            $count = Maquina_imagene::where('maquina_id','=',$maquina_id)
                           ->where('id','=',$id)
                           ->count();
            if($count == 1)
                return true;
            return false;
        }catch(\Exception $ex){
            return false;
        }
    }
}
