<?php

use Illuminate\Http\Request;
use App\Maquina;
use App\Componente;
use App\instruccione;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/maquina/{request}', 'API\MaquinaController@showMaquina');
Route::get('/componente/{maquina}', 'API\ComponenteController@showComponente');
Route::get('/instruccione/{maquina}/{request}', 'API\InstruccioneController@showinstruccione');
//Route::apiResource("maquinas","MaquinaController");


//*********************************************** */

//Route::post('register', 'UserController@register');
//Route::post('login', 'UserController@authenticate');

/*Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', 'UserController@getAuthenticatedUser');
    Route::post('logout', 'UserController@logout');

    Route::get('/maquina', 'API\MaquinaController@index');
    Route::get('/maquina/{maquina}', 'API\MaquinaController@show');
});*/