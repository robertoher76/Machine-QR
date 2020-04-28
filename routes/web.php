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

Route::get('/', 'HomeController@index');

Auth::routes(['register' => false, 'password' => false]);

Route::resource('maquinas','MaquinaController');

Route::resource('maquinas.galeria','ImagenController')->shallow();

Route::resource('maquinas.tutoriales','TutorialController')->shallow();

Route::resource('maquinas.instrucciones','InstruccionController')->shallow();

Route::resource('instrucciones/tipo','InstruccionTipoController');

Route::resource('maquinas.componentes', 'ComponenteController')->shallow();

Route::resource('instrucciones.procedimientos', 'ProcedimientoController')->shallow();