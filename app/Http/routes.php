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

Route::get('/', ['middleware' => 'guest', function () {

	return view('welcome');
}]);


Route::group(array('prefix' => 'user'), function()
{

	Route::get('register',  ['as' => 'getReg' , 'uses' => 'Auth\AuthController@getRegister']);
	Route::post('register', ['as' => 'postReg', 'uses' => 'Auth\AuthController@postRegister']);
	
	Route::get('login',     ['as' => 'getLogin', 'uses' => 'Auth\AuthController@getLogin']);
	Route::post('login',    ['as' => 'postLogin', 'uses' => 'Auth\AuthController@postLogin']);
});

Route::get('logout',    ['as' => 'getLogout', 'uses' => 'Auth\AuthController@getLogout']);

Route::get('home', ['middleware' => 'auth', function () {
    $title = "Home";
	return view('/home')->with(compact('title'));
}]);
