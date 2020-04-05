<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Instruccione extends Model
{
    protected $fillable = ['maquina_id','instrucciones_tipo_id','titulo','descripcion','numero_orden'];

    public function procedimientos(){

        return $this->hasMany('App\Procedimiento');

    }

    public static function getListIntrucciones($maquina_id){
        try{
            return Instruccione::where('maquina_id','=',$maquina_id)
                        ->orderBy('numero_orden')
                        ->get();
        }catch(QueryException $ex){
            return null;
        }
    }

    public static function setNumeroOrdenCreate($maquina_id, $posicion){
        try{
            if(self::getLastInstruccion($maquina_id)+1 == $posicion){
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

    public static function getLastInstruccion($maquina_id){
        try{
            return Instruccione::where('maquina_id','=',$maquina_id)
                               ->count();
        }catch(QueryException $ex){
            return null;
        }
    }

    public static function updateOrdenIncrease($maquina_id, $posicion, $posicionActual = false){
        try{
            if($posicionActual == false){
                $i = self::getLastInstruccion($maquina_id);
                for($i;$i >= $posicion; $i--){
                    Instruccione::where('maquina_id','=',$maquina_id)
                                ->where('numero_orden','=',$i)
                                ->update(['numero_orden' => $i+1]);
                }
            }else{
                $i = $posicionActual-1;
                for($i;$i >= $posicion; $i--){
                    Instruccione::where('maquina_id','=',$maquina_id)
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
                    Instruccione::where('maquina_id','=',$maquina_id)
                                ->where('numero_orden','=',$i)
                                ->update(['numero_orden' => $i-1]);
                }
            }else{
                $i=$posicionActual+1;
                for($i;$i <= self::getLastInstruccion($maquina_id); $i++){
                    Instruccione::where('maquina_id','=',$maquina_id)
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
