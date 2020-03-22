<?php

namespace App;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Maquina extends Model
{
    
    protected $fillable = ['nombre_maquina','descripcion','codigo_qr','imagen'];

    public function maquina_imagenes(){
        
        return $this->hasMany('App\Maquina_imagene');
    }

    public function componentes(){

        return $this->hasMany('App\Componente');

    }

    public function instrucciones(){

        return $this->hasMany('App\Instruccione');

    }

    public function tutoriales(){

        return $this->hasMany('App\Tutoriale');

    }

    public static function setImagenMaquina($foto, $actual = false){
        if($foto){
            if($actual){
                Storage::disk('public')->delete("imagenes/maquinas/$actual");
            }
            $imagenName = Str::random(20) . '.jpg';
            $imagen = Image::make($foto)->encode('jpg',90);
            Storage::disk('public')->put("imagenes/maquinas/$imagenName", $imagen->stream());

            return $imagenName;
        }else{
            return false;
        }
    }

    public static function setQRMaquina($actual = false){
        if($actual){
            Storage::disk('public')->delete("imagenes/QR/$actual");
        }

        $qrName = Str::random(20) . '.png';
        $image = \QrCode::format('png')                
                ->size(1000)->errorCorrection('H')
                ->generate($qrName);
        Storage::disk('public')->put("imagenes/QR/$qrName", $image);

        return $qrName;             
    }

}
