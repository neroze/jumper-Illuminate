<?php

Route::group(['prefix' => env('APP_PREFIX', 'jumper'), 'middleware' => ['web', 'auth', 'impersonate', 'isActive']], function () {
    //Route::get('/jumper-core', 'Jumper\Core\Controllers\CoreController@dash');
    //Route::get('/jumper-core', 'Jumper\Core\Controllers\CoreController@dash');

});

// Route::get('/dash', 'DashboardController@index')->middleware('auth','impersonate','isActive');
