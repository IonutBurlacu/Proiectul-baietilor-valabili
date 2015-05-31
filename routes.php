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

    Route::post('/vote-question', 'User/QuestionController@voteQuestion');
    Route::post('/vote-answer', 'User/QuestionController@voteAnswer');

    Route::get('/profile', 'User/UserController@profileIndex');
    Route::post('/profile/avatar', 'User/UserController@saveAvatar');

    Route::get('/profile/edit', 'User/UserController@editProfileIndex');
    Route::post('/profile/edit', 'User/UserController@editProfile');

    Route::get('/users', 'User/UserController@usersList');

    Route::get('/search', 'User/QuestionController@search');

    /* REST API */

    Route::get('/api/category', 'Api/QuestionController@category');
    Route::get('/api/question', 'Api/QuestionController@details');

 ?>
