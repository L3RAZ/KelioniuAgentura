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
Route::get('/korteles/prideti/{belenkas}','KorteleController@create');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/keliones/{id}', 'KelioneController@show');
Route::get('/pridetiuzsakyma', 'SutartysController@create');
Route::post('/pridetiuzsakyma', 'SutartysController@store');
Route::get('klientouzsakymai', 'SutartysController@showkliento');

Route::get('/klientouzsakymai/{id}', 'PaslaugosController@show');
Route::get('/klientouzsakymai', 'SutartysController@showkliento');

Route::get('/uzsakytiviesbuti', 'PaslaugosController@createViesbutis');
Route::post('/uzsakytiviesbuti', 'PaslaugosController@storeViesbutis');

Route::get('/uzsakytidraudima', 'PaslaugosController@createDraudimas');
Route::post('/uzsakytidraudima', 'PaslaugosController@storeDraudimas');