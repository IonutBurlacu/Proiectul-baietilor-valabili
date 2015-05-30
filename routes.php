<?php

    Route::get('/', 'User/HomeController@latest');

    Route::get('/login', 'User/UserController@indexLogin');
    Route::post('/login', 'User/UserController@login');

    Route::get('/register', 'User/UserController@indexRegister');
    Route::post('/register', 'User/UserController@register');

    Route::get('/logout', 'User/UserController@logout');

    Route::get('/ask', 'User/QuestionController@indexAsk');
    Route::post('/ask', 'User/QuestionController@ask');

    Route::get('/category', 'User/QuestionController@categoryIndex');

    Route::get('/question', 'User/QuestionController@show');
    Route::post('/answer', 'User/QuestionController@answer');
    Route::get('/answer/delete', 'User/QuestionController@deleteAnswer');
    Route::get('/question/delete', 'User/QuestionController@deleteQuestion');

 ?>
