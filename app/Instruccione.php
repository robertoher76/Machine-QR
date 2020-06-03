<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use App\Maquina;
use Illuminate\Support\Facades\DB;

class Instruccione extends Model
{
    protected $fillable = ['maquina_id','instrucciones_tipo_id','titulo','descripcion','numero_orden'];

    public function procedimientos(){

        return $this->hasMany('App\Procedimiento');

    }

    public static function getIntrucciones($maquina_id){
        try{
            return Instruccione::where('maquina_id','=',$maquina_id)
                               ->orderBy('numero_orden')
                               ->get();
        }catch(QueryException $ex){
            return null;
        }
    }

    public static function getIntruccionesPaginate($maquina_id){
        try{
            $instrucciones = Instruccione::where('maquina_id','=',$maquina_id)
                               ->join('instrucciones_tipos', 'instrucciones.instrucciones_tipo_id', '=', 'instrucciones_tipos.id')
                               ->select('instrucciones.*', 'instrucciones_tipos.nombre')
                               ->orderBy('instrucciones.numero_orden')
                               ->paginate(15);
            return Maquina::cortarParrafos($instrucciones, 200);
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

    public static function getIntruccionesId($maquina_id, $id_tipo_instruccion){
        try{
            $row = Instruccione::join('procedimientos', 'procedimientos.instruccione_id', '=', 'instrucciones.id')
                            ->select('instrucciones.id', 'procedimientos.instruccione_id', 'instrucciones.maquina_id', 'instrucciones.instrucciones_tipo_id', 'instrucciones.titulo', 'instrucciones.descripcion', 'procedimientos.descripcion as hecho', 'procedimientos.imagen')
                            ->where('instrucciones.maquina_id','=',$maquina_id)
                            ->where('instrucciones.instrucciones_tipo_id','=',$id_tipo_instruccion)
                            ->orderBy('instrucciones.numero_orden')
                            ->get();
            $aux = 0;
            $jsonAux = "";
            $json = "[";
                for($i = 0; $i < count($row); $i++ ){
                    if($row[$i]['instruccione_id'] != $aux){
                        $json = $json . "{";
                        $json = $json . '"id":"'.$row[$i]['id'].'",';
                        $json = $json . '"instruccione_id":"'.$row[$i]['instruccione_id'].'",';
                        $json = $json . '"maquina_id":"'.$row[$i]['maquina_id'].'",';
                        $json = $json . '"instrucciones_tipo_id":"'.$row[$i]['instrucciones_tipo_id'].'",';
                        $json = $json . '"titulo":"'.$row[$i]['titulo'].'",';
                        $json = $json . '"descripcion":"'.$row[$i]['descripcion'].'",';
                                    
                        $jsonAux = "[";
                        $jsonAux = $jsonAux . '{"hecho":"' . $row[$i]['hecho'] . '"' . ",";
                        $jsonAux = $jsonAux . '"imagen":"' . $row[$i]['imagen'] . '"' . "}";
                                    
                        $aux = $row[$i]['instruccione_id']; 
                    }else{
                        $jsonAux = $jsonAux . ',{"hecho":"' . $row[$i]['hecho'] . '"' . ",";
                        $jsonAux = $jsonAux . '"imagen":"' . $row[$i]['imagen'] . '"' . "}";
                    }
                    if( ($i + 1) < count($row) ){
                        if($row[$i + 1]['instruccione_id'] != $aux){
                            $json = $json . '"procedimiento":'. $jsonAux . "]";
                            $json = $json . "}"; 
                        }
                    }else{
                        $json = $json . '"procedimiento":'. $jsonAux . "]";
                        $json = $json . "}"; 
                    }
            }
            $json = $json . "]";

            return $json;
            /**
             foreach ($cars as $car) {
             $car->type = [["model" => "320", "year" => "2012"], ["model" => "530", "year" => "2013"]];
                dd($car->toJson());
                }
             */
        }catch(QueryException $ex){
            return $ex;
        }
    }
}