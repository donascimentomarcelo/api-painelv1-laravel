<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

	Route::get('/','Auth\AuthController@getLogin');

	Route::post('painel/email',['as' => 'painel.email', 'uses' => 'PainelController@email']);

	Route::get('auth/login', 'Auth\AuthController@getLogin');
	Route::post('auth/login', 'Auth\AuthController@postLogin');
	Route::get('auth/logout', 'Auth\AuthController@getLogout');
	Route::get('auth/register', 'Auth\AuthController@getRegister');
	Route::post('auth/register', 'Auth\AuthController@postRegister');

	Route::group(['prefix'=>'admin', 'middleware'=>'verify', 'as'=>'admin.'],function(){
	
		Route::get('home',['as' => 'painel.index', 'uses' => 'PainelController@index']);
		Route::get('painel/register',['as' => 'painel.user', 'uses' => 'PainelController@createUser']);
		Route::post('painel/save',['as' => 'painel.create.user', 'uses' => 'PainelController@saveUser']);
		Route::get('painel/list',['as' => 'painel.userlist', 'uses' => 'PainelController@listUser']);
		
	});
	