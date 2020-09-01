<?php

use Illuminate\Support\Facades\Route;

# For unauthorized users only
Route::middleware('guest')->group(function() {

    # Account registration
    Route::get('/signup', 'AuthController@getSignup')->name('auth.signup');
    Route::post('/signup', 'AuthController@postSignup');
    
    # Account authorization
    Route::get('/signin', 'AuthController@getSignin')->name('auth.signin');
    Route::post('/signin', 'AuthController@postSignin');

});

# For authorized users only
Route::middleware('auth')->group(function() {
    
    # Signout
    Route::get('/signout', 'AuthController@getSignout')->name('auth.signout');

    # Home page
    Route::get('/', 'HomeController@index')->name('home');

});


