<?php

Route::group(['namespace' => 'Web', 'prefix' => ''], function () {
    Route::get('/', ['uses' => 'TopController@index', 'as' => 'webTopIndex']);

    Route::get('/single', ['uses' => 'TopController@single', 'as' => 'single']);

    Route::group(['middleware' => 'guest:web'], function () {
        Route::get('login', ['uses' => 'UserController@getLogin', 'as' => 'webUserGetLogin']);
        Route::post('login', ['uses' => 'UserController@postLogin', 'as' => 'webUserPostLogin']);
        Route::get('register', ['uses' => 'UserController@getRegister', 'as' => 'webUserGetRegister']);
        Route::post('register', ['uses' => 'UserController@postRegister', 'as' => 'webUserPostRegister']);
    });
    Route::get('logout', ['uses' => 'UserController@logout', 'as' => 'webUserLogout']);
    Route::get('password/reset', ['uses' => 'UserController@showLinkRequestForm', 'as' => 'webUserShowLinkRequestForm']);
    Route::post('password/email', ['uses' => 'UserController@sendResetLinkEmail', 'as' => 'webUserSendResetLinkEmail']);
    Route::get('password/reset/{token}', ['uses' => 'UserController@showResetForm', 'as' => 'webUserShowResetForm']);
    Route::post('password/reset', ['uses' => 'UserController@reset', 'as' => 'webUserReset']);


    Route::get('captcha', ['uses' => 'SystemController@getCaptcha', 'as' => 'webSystemCaptcha']);
});

