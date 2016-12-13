<?php

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/jumper-dash', 'Jumper\Dashboard\Controllers\DashboardController@index');
});
