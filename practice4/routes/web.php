<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//TODO Route for endpoint Cashier & Stripe
Route::post('stripe/webhook', '\App\Http\Controllers\WebhookController@handleWebhook');

Route::group(['middleware' => ['auth']], function(){
    //TODO Subscription Routes
    Route::get('subscription', '\App\Http\Controllers\SubscriptionController@form')->name('subscriptions.form');
    Route::get('subscription/cancel/{plan}', '\App\Http\Controllers\SubscriptionController@cancel')->name('subscriptions.cancel');
    Route::post('subscription/upgrade', '\App\Http\Controllers\SubscriptionController@upgrade')->name('subscriptions.upgrade');
    Route::post('subscription/resume', '\App\Http\Controllers\SubscriptionController@resume')->name('subscriptions.resume');
    Route::post('stripe/process_subscription', '\App\Http\Controllers\SubscriptionController@subscribe')->name('subscriptions.subscribe');

    //TODO Profile Routes
    Route::get('profile', '\App\Http\Controllers\ProfileController@index')->name('profile.index');

    //TODO Invoices Routes
    Route::get('invoices', '\App\Http\Controllers\InvoiceController@index')->name('invoice.index');
    Route::get('invoice/{invoice}', '\App\Http\Controllers\InvoiceController@download')->name('invoice.download');
});
