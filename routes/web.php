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

Route::group(['prefix' => 'medidores'], function () {
  Route::get('/', 'MedidorController@index')->name('medidor.index');
  Route::post('/crear-medidor', 'MedidorController@store')->name('medidor.store');
  Route::get('/mostrar-medidor/{id}', 'MedidorController@show')->name('medidor.show');
  Route::get('/editar-medidor/{id}', 'MedidorController@edit')->name('medidor.edit');
  Route::post('/actualizar-medidor/{medidor}', 'MedidorController@update')->name('medidor.update');
  Route::delete('/eliminar-medidor/{id}', 'MedidorController@destroy')->name('medidor.destroy');
  Route::post('/crear-periodo', 'MedidorController@storePeriodo')->name('periodo.store');
  Route::post('/buscar-periodos', 'MedidorController@searchPeriodo')->name('periodo.search');
});
