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


Auth::routes();


Route::get('/', 'MotoController@viewMotoList');

Route::get('/moto/dodaj', 'MotoController@dodajMoto');
Route::post('/moto/do_dodaj', 'MotoController@do_dodajMoto');
Route::get('/moto/list', 'MotoController@viewMotoList');
Route::get('/moto/edit/{id}', 'MotoController@editMoto');
Route::get('/moto/loan/{id}', 'MotoController@loanMoto');
Route::post('/moto/do-loan', 'MotoController@doLoanMoto');

Route::get('/wypo/list', 'WypoController@viewWypoList');
Route::get('/wypo/res/{id}', 'WypoController@resWypo');

Route::get('/user/list', 'UserController@viewUserList');
Route::get('/user/edit/{id}', 'UserController@editUser');
Route::post('/user/do-edit/{id}', 'UserController@doEdit');
Route::get('/user/delete/{id}', 'UserController@deleteUser');




Route::get('/home', 'HomeController@index')->name('home');