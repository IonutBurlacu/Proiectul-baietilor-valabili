<?php

    if(Auth::getUserId() != null){
        /* Auth routes */
        Route::get('/logout', 'User/UserController@logout');

        Route::get('/ask', 'User/QuestionController@indexAsk');
        Route::post('/ask', 'User/QuestionController@ask');

        Route::post('/answer', 'User/QuestionController@answer');
        Route::get('/answer/delete', 'User/QuestionController@deleteAnswer');
        Route::get('/question/delete', 'User/QuestionController@deleteQuestion');

        Route::post('/vote-question', 'User/QuestionController@voteQuestion');
        Route::post('/vote-answer', 'User/QuestionController@voteAnswer');

        Route::get('/report-question', 'User/QuestionController@reportQuestion');
        Route::get('/report-answer', 'User/QuestionController@reportAnswer');

        Route::get('/profile/edit', 'User/UserController@editProfileIndex');
        Route::post('/profile/edit', 'User/UserController@editProfile');
    }

    Route::get('/', 'User/HomeController@latest');

    Route::get('/login', 'User/UserController@indexLogin');
    Route::post('/login', 'User/UserController@login');

    Route::get('/register', 'User/UserController@indexRegister');
    Route::post('/register', 'User/UserController@register');

    Route::get('/forgot', 'User/UserController@forgotIndex');
    Route::post('/forgot', 'User/UserController@forgot');

    Route::get('/reset', 'User/UserController@resetIndex');
    Route::post('/reset', 'User/UserController@reset');

    Route::get('/category', 'User/QuestionController@categoryIndex');

    Route::get('/question', 'User/QuestionController@show');

    Route::get('/profile', 'User/UserController@profileIndex');
    Route::post('/profile/avatar', 'User/UserController@saveAvatar');

    Route::get('/users', 'User/UserController@usersList');

    Route::get('/search', 'User/QuestionController@search');

    /* REST API */

    Route::get('/api/category', 'Api/QuestionController@category');
    Route::get('/api/question', 'Api/QuestionController@details');
    Route::get('/api/latest', 'Api/QuestionController@latest');

    Route::get('/api/users', 'Api/UserController@usersList');
    Route::get('/api/profile', 'Api/UserController@profile');

    Route::post('/api/ask', 'Api/QuestionController@ask');
    Route::post('/api/answer', 'Api/QuestionController@answer');

    Route::post('/api/vote-question', 'Api/QuestionController@voteQuestion');
    Route::post('/api/vote-answer', 'Api/QuestionController@voteAnswer');

    Route::post('/api/delete-question', 'Api/QuestionController@deleteQuestion');
    Route::post('/api/delete-answer', 'Api/QuestionController@deleteAnswer');

 ?>
