<?php

    Route::get('/', 'HomeController@index');
    Route::get('/login', 'UserController@indexLogin');
    Route::post('/login', 'UserController@login');

 ?>
