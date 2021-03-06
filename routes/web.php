<?php

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
    return view('welcome');
});

Route::get('/kontak', ['as' => 'kontak.all', 'uses' => 'KontakController@index']);
Route::get('/kontak/{id}', [ 'as' => 'kontak.id', 'uses' => 'KontakController@show']);
// Route::post('/kontak/store', [ 'as' => 'kontak.store', 'uses' => 'KontakController@store']);
// Route::put('/kontak/update/{id}', [ 'as' => 'kontak.update', 'uses' => 'KontakController@update']);
// Route::delete('/kontak/delete/{id}', [ 'as' => 'kontak.delete', 'uses' => 'KontakController@destroy']);