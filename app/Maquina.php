<?php

namespace App;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Procedimiento;
use App\Instruccione;
use App\Tutoriale;

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

    public static function getInstruccionesPaginate($maquina_id, $paginate = 15){
        try {
            $instrucciones = Maquina::join('instrucciones', 'instrucciones.maquina_id', '=', 'maquinas.id')
                            ->join('instrucciones_tipos','instrucciones_tipos.id','=','instrucciones.instrucciones_tipo_id')
                            ->select('instrucciones_tipos.nombre','instrucciones.*')
                            ->where('maquinas.id','=',$maquina_id)
                            ->orderBy('instrucciones.numero_orden')
                            ->paginate(6);
            return self::cortarParrafos($instrucciones, 200);
        } catch (QueryException $ex) {
            return null;
        }
    }

    public static function getMaquinas(){
        try{
            $maquinas = Maquina::paginate(15);
            return self::cortarParrafos($maquinas,100);
        }catch(\Exception $ex){
            return null;
        }
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
        $qrName = Str::random(20);
        $image = \QrCode::format('png')
                ->size(1000)->errorCorrection('H')
                ->generate($qrName);
        Storage::disk('public')->put("imagenes/QR/$qrName.png", $image);

        return $qrName;
    }

    public static function cortarParrafos($maquinas, $fin){
        foreach ($maquinas as $maquina) {
            $maquina->descripcion = substr($maquina->descripcion, 0, $fin) . '...';
        }
        return $maquinas;
    }

}
