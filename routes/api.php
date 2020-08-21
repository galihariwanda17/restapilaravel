<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::get('/ambil-kontak', 'ControllerKontak@index')->name('kontak.all');
// Route::group(array('prefix'=>'api'),function(){
// 	Route::resource('kontak','ControllerKontak',array('except'=>array('create','edit')));
// });
Route::group([
  'prefix' => 'auth'
], function ($router) {
  Route::post('login', 'AuthController@login');
  Route::post('logout', 'AuthController@logout');
  Route::post('refresh', 'AuthController@refresh');
  Route::post('me', 'AuthController@me');

});
Route::resource('kontak', 'ControllerKontak', array('except'=>array('create','edit')));
