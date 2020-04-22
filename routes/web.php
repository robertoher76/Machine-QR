<?php

use App\Maquina;
use App\Componente;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('qrcode', function () {

    $image = \QrCode::format('png')
                 ->size(1000)->errorCorrection('H')
                 ->generate('A simple example of QR code!');
    $output_file = '/imagenes/QR/img-' . time() . '.png';
    Storage::disk('local')->put($output_file, $image); //storage/app/public/img/qr-code/img-1557309130.png

    return "Hola";
});

Route::resource('/maquinas','MaquinaController');

Route::resource('/maquinas/{maquina}/galeria','ImagenController');

Route::resource('/maquinas/{maquina}/tutoriales','TutorialController');

Route::resource('/maquinas/{maquina}/instrucciones','InstruccionController');

Route::resource('/instrucciones/tipo','InstruccionTipoController');

Route::resource('/maquinas/{maquina}/componente', 'ComponenteController');

Route::resource('/maquinas/instrucciones/{instruccione}/procedimientos', 'ProcedimientoController');
