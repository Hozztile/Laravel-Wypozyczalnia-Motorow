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
Route::get('/log-or-reg', 'MotoController@logOrReg');
Route::post('/check', 'MotoController@check');

Route::get('/moto/dodaj', 'MotoController@dodajMoto');
Route::post('/moto/do_dodaj', 'MotoController@do_dodajMoto');
Route::get('/moto/list', 'MotoController@viewMotoList');
Route::post('/moto/search', 'MotoController@searchMotoList');
Route::get('/moto/delete/{id}', 'MotoController@deleteMoto');
Route::get('/moto/edit/{id}', 'MotoController@editMoto');
Route::post('/moto/do-edit/{id}', 'MotoController@doEdit');
Route::post('/moto/do-edit-zdj/{id}', 'MotoController@doEditZdj');
Route::get('/moto/loan/{id}', 'MotoController@loanMoto');
Route::post('/moto/do-loan', 'MotoController@doLoanMoto');
Route::get('/moto/service/{id}', 'MotoController@serviceMoto');
Route::post('/moto/do-service', 'MotoController@doServiceMoto');
Route::get('/log-or-reg', 'MotoController@logOrReg');

Route::get('/wypo/list', 'WypoController@viewWypoList');
Route::get('/wypo/list/{id}', 'WypoController@viewWypoListUser');
Route::get('/wypo/res/{id}', 'WypoController@resWypo');

Route::get('/user/list', 'UserController@viewUserList');
Route::get('/user/edit/{id}', 'UserController@editUser');
Route::post('/user/do-edit/{id}', 'UserController@doEdit');
Route::get('/user/delete/{id}', 'UserController@deleteUser');




Route::get('/home', 'HomeController@index')->name('home');