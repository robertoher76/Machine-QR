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

Route::get('/', 'HomeController@index')->name('index');

Route::get('inicio', 'HomeController@home')->name('inicio');

Auth::routes(['register' => false]);

Route::get('usuario', 'UserController@index')->middleware('auth');

Route::resource('maquinas','MaquinaController');

Route::resource('maquinas.galeria','ImagenController')->shallow();

Route::resource('maquinas.tutoriales','TutorialController')->shallow();

Route::resource('maquinas.instrucciones','InstruccionController')->shallow();

Route::resource('instrucciones/tipo','InstruccionTipoController');

Route::resource('maquinas.componentes', 'ComponenteController')->shallow();

Route::resource('instrucciones.procedimientos', 'ProcedimientoController')->shallow();

Route::get('maquinas/{maquina}/cambiar-imagen-maquina','MaquinaController@uploadImagen')->name('maquina.imagen');
Route::get('maquinas/{maquina}/seleccionar-imagen-galeria','MaquinaController@showGaleria')->name('maquina.galeria');
Route::post('maquinas/{maquina}/subir-imagen-maquina','MaquinaController@saveImagen')->name('maquina.save');
Route::post('maquinas/{maquina}/seleccionar-imagen-galeria','MaquinaController@updateImagen')->name('maquina.select');