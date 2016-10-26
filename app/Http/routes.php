<?php

Route::group(['middleware' => ['api']],function(){

	//===== User Authentication
	Route::post('/auth/signup', [
		'uses' => 'AuthController@signup',
	]);

	Route::group(['middleware' => 'throttle:8'], function(){
		Route::post('/auth/signin', [
			'uses' => 'AuthController@signin',
		]);
	});

	Route::get('/auth/signout', [
		'uses' => 'AuthController@signout',
	]);

	Route::get('/user/activate',[
		'uses' => 'UserController@accountActivation',
	]);

	//====== Authenticated User
	Route::group(['middleware' => 'jwt.auth'], function(){
		Route::get('/user', [
			'uses' => 'UserController@index',
		]);

		//Plans
		Route::get('/plans',[
			'uses' => 'PlanController@index'
		]);

		Route::post('/subscription', [
			'uses' => 'SubscriptionController@create'
		]);

	    Route::group(['middleware' => 'subscribed'], function () {
	        Route::get('/subscription', [
	        	'uses' => 'SubscriptionController@index'
	    	]);
	        Route::post('/subscription/cancel', [
	        	'uses' => 'SubscriptionController@cancel'
	    	]);
	        Route::post('/subscription/resume', [
	        	'uses' => 'SubscriptionController@resume'
	    	]);
	    });
	});

});
// Route::auth();

Route::get('/home', 'HomeController@index');
