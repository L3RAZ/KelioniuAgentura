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

Route::get('/', 'KelioneController@index');

//Route::view('/', 'layouts.index');


/*Route::get('/', function () {
    return view('layouts.index');
});*/
Auth::routes();
Route::resource('korteles', 'KorteleController');
Route::get('/korteles/prideti/{new}','KorteleController@create');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/keliones/{id}', 'KelioneController@show');
Route::get('/pridetiuzsakyma', 'SutartysController@create');
Route::post('/pridetiuzsakyma', 'SutartysController@store');
Route::get('klientouzsakymai', 'SutartysController@showkliento');

Route::get('/klientouzsakymai/{id}', 'PaslaugosController@show');
Route::get('/klientouzsakymai', 'SutartysController@showkliento');

Route::patch('/sutartys/{id}', 'SutartysController@update');
Route::get('/viesbuciai/prideti','ViesbuciaiController@create');
Route::post('/viesbuciai/{kazkas}','ViesbuciaiController@store');
Route::get('/miestai/prideti', 'MiestaiController@create');
Route::post('/miestai/{kazkas}','MiestaiController@store');

Route::get('/sutartys/patvirtinimai/{id}','SutartysController@rodytidarbuotojui');
