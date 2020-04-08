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
            $componentes =  Componente::where("maquina_id","=",$maquina_id)->paginate($paginate);
            return Maquina::cortarParrafos($componentes,110);
        }catch(\Exception $ex){
            return null;
        }
    }
}
