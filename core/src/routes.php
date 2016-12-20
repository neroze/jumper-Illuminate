<?php
//Route::group(['prefix' => env('APP_PREFIX', 'jumper'), 'middleware' => ['web', 'impersonate']], function () {
Route::group(['middleware' => ['web', 'impersonate']], function () {
    Route::get('user-inactive', function(){
		    return view('jumperCore::errors.inactive');
		});

		Route::get('upgrade-account', function(){
		    return view('jumperCore::errors.upgrade');
		});

		Route::get('ilegal-action', function(){
		    return view('jumperCore::errors.ilegalAction');
		});
		Route::get('trail-ends', function(){
		    return view('jumperCore::errors.trail_ends');
		});
		Route::get('invalid-subscription', function(){
		    return view('jumperCore::errors.invalid_subscription');
		});

		Route::post(
		    'stripe/webhook',
		    '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook'
		);

});

// Route::get('/dash', 'DashboardController@index')->middleware('auth','impersonate','isActive');
