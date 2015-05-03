<?php

    Route::get('/', 'User/HomeController@index');
    Route::get('/login', "User/UserController@indexLogin");
    Route::post('/login', 'User/UserController@login');

    Route::get('/questions', 'User/QuestionController@show');

 ?>
