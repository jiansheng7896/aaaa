<?php
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin::'], function () {

    Route::get('/', ['uses' => 'TopController@index', 'as' => 'top::index']);
});

Route::group(['namespace' => 'Api', 'prefix' => ''], function () {


});

Route::group(['namespace' => 'Web', 'prefix' => ''], function () {
    Route::get('/', ['uses' => 'TopController@index']);

    Route::group(['middleware' => 'guest:web'], function () {
        Route::get('login', ['uses' => 'UserController@getLogin']);
        Route::post('login', ['uses' => 'UserController@postLogin']);
        Route::get('register', ['uses' => 'UserController@getRegister']);
        Route::post('register', ['uses' => 'UserController@postRegister']);
    });
    Route::get('logout', ['uses' => 'UserController@logout']);
    Route::get('password/reset', ['uses' => 'UserController@showLinkRequestForm']);
    Route::post('password/email', ['uses' => 'UserController@sendResetLinkEmail']);
    Route::get('password/reset/{token}', ['uses' => 'UserController@showResetForm']);
    Route::post('password/reset', ['uses' => 'UserController@reset']);


    Route::get('captcha', ['uses' => 'SystemController@getCaptcha']);
});

Route::get('/redirect', function () {
    $query = http_build_query([
        'client_id' => '3',
        'redirect_uri' => 'http://www.laravel54.com/callback',
        'response_type' => 'code',
        'scope' => '',
    ]);

    return redirect('http://192.168.169.128/oauth/authorize?'.$query);
});




Route::get('/callback', function (Request $request) {
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://192.168.169.128/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => '3',
            'client_secret' => 'uaJMvtzYacZ1HavwCpAvCxgeWbhpR0E87EhGvTau',
            'redirect_uri' => 'http://www.laravel54.com/callback',
            'code' => $request::input('code'),
        ],
    ]);

    return json_decode((string) $response->getBody(), true);
});

Route::get('/token', function () {
    $http = new GuzzleHttp\Client;

    $response = $http->request('POST', 'http://192.168.169.128/oauth/token', [
//        'headers' => [
//            'Accept' => 'application/json',
//            'Authorization' => 'Basic '.base64_encode(sprintf('%s:%s', '3', 'uaJMvtzYacZ1HavwCpAvCxgeWbhpR0E87EhGvTau')),
//        ],
        'form_params' => [
            'grant_type' => 'password',
            'client_id' => '3',
            'client_secret' => 'uaJMvtzYacZ1HavwCpAvCxgeWbhpR0E87EhGvTau',
            'username' => 'nosjoy@163.com',
            'password' => '123456',
            'scope' => '',
        ],
    ]);
//    $response = $http->post('http://192.168.169.128/oauth/token', [
//        'form_params' => [
//            'grant_type' => 'password',
//            'client_id' => '3',
//            'client_secret' => 'uaJMvtzYacZ1HavwCpAvCxgeWbhpR0E87EhGvTau',
//            'username' => 'nosjoy@163.com',
//            'password' => '123456',
//            'scope' => '',
//        ],
//    ]);

    return json_decode((string) $response->getBody(), true);
});

Route::get('/refresh', function (Request $request) {
    $http = new GuzzleHttp\Client;



    $response = $http->post('http://192.168.169.128/oauth/token', [
        'form_params' => [
            'grant_type' => 'refresh_token',
            'refresh_token' => 'X+1RYOJE9qldC+yvzFHy79NVTQfslu3eq4J6HMrBOl\/wbEj+rHMundHGFhBBEjeBh+3\/1SGK\/0z\/oJFZ1+FlBG450fA80DVe6J4cOPOGZEveW+nRjCitDNoCebVNqkvoiZmVJ+hkw6RbPU0q5ylt0xhYzYlptz+DlFsuFCMO8l7B5suwsa+sTSP1qlvQ5DDXHRMHVM+aTxicoPcIFtzdnSh\/Jd+qbXQ8v\/RO55vXPAATcaNoySCh+Jun0FM7lh14jHS0O0vnXVP4lAOA0j+gqsbjT7iHLsk4m9HcxYkrUP0DPO\/MToZmX0RQChXr4h\/tj\/LxXdNtiC6oJa30UoXF0LAwY0E4T\/TaUtKMf0xty3MO7zLa9O2UselKlJ62DWzeyBbWs7PlWMDKxzkvM2sUT+906R3S4IYzANbPnxSFI3m\/dI5XUeXtQhDf9xKbTSSEbJ8XzYShWRq5QRvA9nqEMvSNw2TarP\/DH9AScx1TfHC\/0oZ\/9xtEkxAOfLSiw0PMoRKTik8Qyy7Bu2ML\/JTbTc\/zDa8TwFpOSax5hvsDOkyNBkIEc96DNAV2J\/PrXhmzVp60zrB9d6TuExWlA6u0eda3I2wbfzcrNg5wOqxG1NzIWfwpaRzD95EE5D33S7yUAD8+Pog6Bh4BMuV\/jZVuo\/tA\/w6d\/m9qti9pn9DEhuU=',
            'client_id' => '3',
            'client_secret' => 'uaJMvtzYacZ1HavwCpAvCxgeWbhpR0E87EhGvTau',
            'scope' => '',
        ],
    ]);

    return json_decode((string) $response->getBody(), true);
});

Route::get('/get', function (Request $request) {
    $http = new GuzzleHttp\Client;

    $response = $http->request('GET', 'http://192.168.169.128/api/user', [
        'headers' => [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$request::input('token'),
        ],
    ]);

    return json_decode((string) $response->getBody(), true);
});
