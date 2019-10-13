<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login')->middleware('cors');
    Route::post('signup', 'AuthController@signup')->middleware('cors');

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout')->middleware('cors');
        Route::get('user', 'AuthController@user')->middleware('cors');
    });
});


Route::post('/roles/create', 'rolesController@store')->middleware('cors');

Route::get('/roles/nuevorol', 'rolesController@nuevorol')->middleware('cors');

Route::post('/roles/update/{id}', 'rolesController@update')->middleware('cors');

Route::delete('/roles/borrarRol/{id}', 'rolesController@borrarRol')->middleware('cors');

Route::get('/roles/asignarRol/{idusu}/rol/{idrol}', 'rolesController@asignarRol')->middleware('cors');

Route::get('/roles/verRol/{id}', 'rolesController@verRol')->middleware('cors');

Route::get('/roles/quitarRol/{idusu}/rol/{idrol}', 'rolesController@quitarRol')->middleware('cors');





