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

Route::get('/', ['middleware' => 'auth', function(){
		return view('indexs');
}]);

Route::get('home', ['middleware' => 'auth', function(){
		return view('home');
}]);

Route::get('kia', function()
{
	
	return View('kiaibu');
});

Route::get('kiaibu', function()
{
	
	return View('kia2');
});

Route::get('kiaibu3', function()
{
	
	return View('kia3');
});

Route::get('kiaibu4', function()
{
	
	return View('kia4');
});

Route::get('kiaibu5', function()
{
	
	return View('kia5');
});




//route to create xls tempalte
Route::get('kia1/{key}', 'KiaController@createkia1');
Route::get('kia2/{key}', 'KiaController@createkia2');
Route::get('kia3/{key}', 'KiaController@createkia3');
Route::get('kia4/{key}', 'KiaController@createkia4');
Route::get('kia5/{key}', 'KiaController@createkia5');


/* kia1 route

*/

//login
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::get('indek', 'StatsController@getIndex');
Route::get('api', 'StatsController@getApi');
