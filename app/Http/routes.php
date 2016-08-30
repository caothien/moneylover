<?php

Route::auth();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');

Route::get('/addtypemoney', 'HomeController@addTypemoney');

Route::post('/addtypemoney', 'HomeController@addTypemoneySuccess');

Route::get('/addwallet', 'HomeController@addWallet');

Route::post('/addwallet', 'HomeController@addData');

Route::get('/deletewallet/{id}', 'HomeController@deleteWallet');

Route::get('/editwallet/{id}', 'HomeController@editWallet');

Route::post('/updatewallet', 'HomeController@updateWallet');

Route::get('/transfer', 'HomeController@transfer');

Route::post('/transfer', 'HomeController@transfersuccess');