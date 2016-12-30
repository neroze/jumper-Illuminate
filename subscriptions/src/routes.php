<?php
  Route::group(['prefix' => env('APP_PREFIX', 'jumper'), 'middleware' => ['web', 'auth']], function () {
  // Protected route
  Route::get('subscriptions', 'Jumper\Subscriptions\Controllers\SubscriptionsController@index');
  Route::get('all-orders', 'Jumper\Subscriptions\Controllers\SubscriptionsController@allOrders');
});
