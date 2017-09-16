<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::post(
	'stripe/webhook',
	'\App\Http\Controllers\WebhookController@handleWebhook'
);

Route::group(['middleware' => ['auth']], function()
{
	Route::get('subscription', '\App\Http\Controllers\SubscriptionController@form')->name('subscriptions.form');
	Route::post('stripe/process_subscription', '\App\Http\Controllers\SubscriptionController@subscribe')->name('subscriptions.subscribe');
	Route::get('subscription/cancel/{plan}', '\App\Http\Controllers\SubscriptionController@cancel')->name('subscriptions.cancel');
	Route::post('subscription/upgrade', '\App\Http\Controllers\SubscriptionController@upgrade')->name('subscriptions.upgrade');
	Route::post('subscription/resume', '\App\Http\Controllers\SubscriptionController@resume')->name('subscriptions.resume');

	/*
	 * RUTAS DE PROFILE
	 */
	Route::get('profile', '\App\Http\Controllers\ProfileController@index')->name('profile.index');

	/**
	 * RUTAS DE FACTURAS
	 */
	Route::get('invoices', '\App\Http\Controllers\InvoiceController@index')->name('invoice.index');
	Route::get('invoice/{invoice}', '\App\Http\Controllers\InvoiceController@download')->name('invoice.download');
});


