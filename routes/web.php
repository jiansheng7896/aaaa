<?php

Route::group(['namespace' => 'Web', 'prefix' => ''], function () {
    Route::get('/', ['uses' => 'TopController@index', 'as' => 'webTopIndex']);

    Route::group(['middleware' => 'guest:web'], function () {
        Route::get('/login', ['uses' => 'UserController@getLogin', 'as' => 'webUserGetLogin']);
        Route::post('/login', ['uses' => 'UserController@postLogin', 'as' => 'webUserPostLogin']);
        Route::get('/register', ['uses' => 'UserController@getRegister', 'as' => 'webUserGetRegister']);
        Route::post('/register', ['uses' => 'UserController@postRegister', 'as' => 'webUserPostRegister']);
    });
    Route::get('/logout', ['uses' => 'UserController@logout', 'as' => 'webUserLogout']);
});

