<?php

Route::group(['middleware' => ['web']], function () {
	//Route::get('/jumper-core', 'Jumper\Core\Controllers\CoreController@dash');
});

// Route::get('/dash', 'DashboardController@index')->middleware('auth','impersonate','isActive');