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
    return view('home');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'registro'], function () {
  Route::get('/', 'MedidorController@index')->name('medidor.index');
  Route::post('/crear-medidor', 'MedidorController@store')->name('medidor.store');
  Route::delete('/eliminar-medidor/{id}', 'MedidorController@destroy')->name('medidor.destroy');
});
