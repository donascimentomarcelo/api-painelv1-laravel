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

			// Route::get('project/list',['as' => 'admin.painel.projectlist', 'uses' => 'ProjectController@listProject']);

	Route::group(['prefix'=>'admin', 'middleware'=>'verify', 'as'=>'admin.'],function(){
	
		Route::get('home',['as' => 'painel.index', 'uses' => 'PainelController@index']);
		Route::get('painel/register',['as' => 'painel.user', 'uses' => 'PainelController@createUser']);
		Route::post('painel/save',['as' => 'painel.create.user', 'uses' => 'PainelController@saveUser']);
		Route::get('painel/list',['as' => 'painel.userlist', 'uses' => 'PainelController@listUser']);

		Route::get('project/register',['as' => 'painel.project', 'uses' => 'ProjectController@createProject']);
		Route::post('project/save',['as' => 'painel.create.project', 'uses' => 'ProjectController@saveProject']);
		Route::get('project/list',['as' => 'painel.projectlist', 'uses' => 'ProjectController@listProject']);
		Route::get('project/edit/{id}',['as' => 'painel.edit', 'uses' => 'ProjectController@editProject']);
		Route::post('project/update/{id}',['as' => 'painel.update', 'uses' => 'ProjectController@updateProject']);
		Route::get('image/edit/{id}',['as' => 'painel.image', 'uses' => 'ProjectController@editImage']);
		Route::post('image/update/{id}',['as' => 'painel.image.update', 'uses' => 'ProjectController@updateImage']);
		Route::get('image/delete/{id}',['as' => 'painel.image.delete', 'uses' => 'ProjectController@deleteImage']);
		Route::post('image/destroy/{id}',['as' => 'painel.image.destroy', 'uses' => 'ProjectController@destroyImage']);
		Route::get('image/add/{id}',['as' => 'painel.image.add', 'uses' => 'ProjectController@addImage']);
		Route::post('image/save/{id}',['as' => 'painel.image.save', 'uses' => 'ProjectController@saveImage']);
		
	});
	