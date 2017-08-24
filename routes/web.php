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
Route::get('/orm','Admin\ViewController@orm');
Route::match(['post','get'],'/login','Admin\ViewController@login');
Route::group(['pl'=>'admin','middleware'=>'houtai'],function(){
	Route::match(['post','get'],'/list{id}','Admin\RostController@index');
	Route::match(['post','get'],'/add{id}','Admin\RostController@create');
	Route::match(['post','get'],'/store{id}','Admin\RostController@store');
	Route::match(['post','get'],'/edit{ed}{id}','Admin\RostController@edit');
	Route::match(['post','get'],'/destroy{id?}','Admin\RostController@destroy');
	Route::match(['post','get'],'/update{id?}','Admin\RostController@update');
	Route::match(['post','get'],'/index','Admin\ViewController@index');
	Route::match(['post','get'],'/out','Admin\ViewController@logingut');
	Route::resource('auth','Admin\Authcontroller');
});
//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
