<?php


Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/', function () {
        echo 1111111111;
    });
});
