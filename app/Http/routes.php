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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api/modules', 'namespace' => 'Modules'], function() {
	Route::resource('advisory', 'AdvisoryController');
	Route::resource('cluster', 'ClusterController');
	Route::resource('contact-number', 'ContactNumberController');
	Route::resource('contact-group', 'ContactNumberGroupController');
	Route::resource('ticket', 'TicketController');
	Route::resource('ticket-location', 'TicketLocationController');
	Route::resource('user', 'UserController');
	Route::resource('user-detail', 'UserDetailController');
});

Route::group(['prefix' => 'api/sms', 'namespace' => 'Sms'], function() {
	Route::group(['prefix' => 'inbound'], function(){
		Route::post('', 'IncomingController@inbound');			
	});
});