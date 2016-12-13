<?php

Route::group(['prefix' => env('APP_PREFIX', 'jumper'), 'middleware' => ['web', 'auth', 'impersonate', 'isActive']], function () {
    Route::resource('role', 'Jumper\Role\Controllers\RoleController');
  Route::get('role-manage', 'Jumper\Role\Controllers\RoleController@manage');
});

// Route::get('/dash', 'DashboardController@index')->middleware('auth','impersonate','isActive');
