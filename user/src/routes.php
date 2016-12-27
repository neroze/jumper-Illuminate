<?php

// Route::group(['prefix' => env('APP_PREFIX', 'jumper'), 'middleware' => ['web', 'auth', 'impersonate', 'isActive']], function () {
Route::group(['prefix' => env('APP_PREFIX', 'jumper'), 'middleware' => ['web', 'auth']], function () {
     // Protected route
    Route::get('manage-user', 'Jumper\User\Controllers\UserController@index');
    Route::post('add-new-user', 'Jumper\User\Controllers\UserController@addNewUser');
    Route::post('save-user/{id}', 'Jumper\User\Controllers\UserController@updateUser');
    Route::get('all-users', 'Jumper\User\Controllers\UserController@allUsers');
    Route::get('all-users/{role}', 'Jumper\User\Controllers\UserController@allUsers');
    Route::post('delete-user/{id}', 'Jumper\User\Controllers\UserController@deleteUser');
    Route::post('update-user-status/{id}', 'Jumper\User\Controllers\UserController@updateUserStatus');

    Route::get('user/account', 'Jumper\User\Controllers\UserController@account');
    Route::get('user/subscribe', 'Jumper\User\Controllers\UserController@subscribe');
    Route::post('user/process-subscription', 'Jumper\User\Controllers\UserController@process_subscription');
    Route::get('user/cancel-subscription', 'Jumper\User\Controllers\UserController@cancel_subscription');
    Route::get('user/resume-subscription', 'Jumper\User\Controllers\UserController@resume_subscription');

    Route::post('save_profile_pic', 'Jumper\User\Controllers\UserController@saveProfilePic');
    Route::post('delete_profile_pic', 'Jumper\User\Controllers\UserController@deleteProfilePic');
    Route::get('logout', 'Auth\LoginController@logout');

});
