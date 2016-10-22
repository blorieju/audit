<?php

Route::group(['middleware' => ['api']],function(){

	//===== User Authentication
	Route::post('/auth/signup', [
		'uses' => 'AuthController@signup',
	]);

	Route::post('/auth/signin', [
		'uses' => 'AuthController@signin',
	]);

	Route::get('/user/activate',[
		'uses' => 'UserController@accountActivation',
	]);
	//====== Authenticated User
	Route::group(['middleware' => 'jwt.auth'], function(){
		Route::get('/user', [
			'uses' => 'UserController@index',
		]);
	});

});

// Route::auth();

Route::get('/home', 'HomeController@index');
