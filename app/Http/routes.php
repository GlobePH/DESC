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


Route::group(['middleware' => ['web']], function () {
	Route::group(['namespace' => 'Frontend'], function() {

		Route::get('dashboard', 'PageController@dashboard');
		Route::get('graphs', 'PageController@graphs');

		Route::resource('advisory', 'AdvisoryController');
		Route::resource('cluster', 'ClusterController');
		Route::resource('account', 'UserController');

	});

	Route::group(['namespace' => 'Auth'], function() {
		Route::get('login', 'AuthController@login');
		Route::post('login', 'AuthController@processLogin');
		Route::get('logout', 'AuthController@logout');
	});

});

Route::group(['prefix' => 'api/modules', 'namespace' => 'Modules'], function() {
	Route::resource('advisory', 'AdvisoryController');
	Route::resource('cluster', 'ClusterController');
	Route::resource('contact-number', 'ContactNumberController');
	Route::resource('contact-group', 'ContactNumberGroupController');
	Route::resource('ticket', 'TicketController');
	Route::resource('ticket-location', 'TicketLocationController');
	Route::get('user/type', 'UserController@types');
	Route::get('user/randomize/{cluster_id}', 'UserController@assignRandom');
	Route::resource('user', 'UserController');
	Route::resource('user-detail', 'UserDetailController');
});

Route::group(['prefix' => 'api/sms', 'namespace' => 'Sms'], function() {
	Route::group(['prefix' => 'inbound'], function(){
		Route::post('', 'IncomingController@inbound');			
	});
});