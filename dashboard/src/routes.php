<?php

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/jumper-dash', 'Jumper\Dashboard\Controllers\DashboardController@index');
    Route::get('/', 'Jumper\Dashboard\Controllers\DashboardController@index');
});
