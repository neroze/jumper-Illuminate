<?php

Route::get('namstey', function () {
    echo 'Hello Namstey, Bro';
});
Route::get('jumper-hi', 'Jumper\Namstey\Controllers\NamsteyController@hi');
Route::get('jumper-hello', 'Jumper\Namstey\Example@test');
