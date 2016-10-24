<?php

Route::group(['middleware' => ['api']],function(){

	//===== User Authentication
	Route::post('/auth/signup', [
		'uses' => 'AuthController@signup',
	]);

	Route::post('/auth/signin', [
		'uses' => 'AuthController@signin',
	]);

	Route::get('/auth/signout', [
		'uses' => 'AuthController@signout',
	]);

	Route::get('/user/activate',[
		'uses' => 'UserController@accountActivation',
	]);

	Route::get('/services', function(){
		dd('data here');
	});
	//====== Authenticated User
	Route::group(['middleware' => 'jwt.auth'], function(){
		Route::get('/user', [
			'uses' => 'UserController@index',
		]);

		//Plans
		Route::get('/plans',[
			'uses' => 'PlanController@index'
		]);
	});

});
// Route::auth();

Route::get('/home', 'HomeController@index');
