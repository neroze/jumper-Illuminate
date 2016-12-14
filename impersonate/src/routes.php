<?php
    Route::group(['prefix' => env('APP_PREFIX', 'jumper'), 'middleware' => ['web', 'auth', 'impersonate', 'isActive']], function () {
      
      Route::get('users/{id}/impersonate', 'Jumper\Impersonate\Controllers\ImpersonateController@impersonate');
    	Route::get('users/stop-impersonate', 'Jumper\Impersonate\Controllers\ImpersonateController@stopImpersonate');

	});
