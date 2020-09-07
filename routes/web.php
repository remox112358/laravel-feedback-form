<?php

use Illuminate\Support\Facades\Route;

# For unauthorized users only
Route::middleware('guest')->group(function() {

    # Signup
    Route::get('/signup', 'AuthController@getSignup')->name('auth.signup');
    Route::post('/signup', 'AuthController@postSignup');
    
    # Signin
    Route::get('/signin', 'AuthController@getSignin')->name('auth.signin');
    Route::post('/signin', 'AuthController@postSignin');

});

# For authorized users only
Route::middleware('auth')->group(function() {
    
    # For users only (no admin)
    Route::middleware('user')->group(function() {

        # Home page
        Route::get('/', 'FeedbackController@create')->name('home');
        
        # If the user doesn`t have a lock
        Route::middleware('can_send')->group(function() {

            # Feedback
            Route::post('/feedback/send', 'FeedbackController@store')->name('feedback.store');

        });

    });

    # Signout
    Route::get('/signout', 'AuthController@getSignout')->name('auth.signout');

    # For users with admin permissions
    Route::middleware('admin')->group(function() {

        # Home page
        Route::get('/feedbacks', 'FeedbackController@index')->name('feedbacks');
    
        # Feedback
        Route::get('/feedback/{feedback}', 'FeedbackController@show')->name('feedback.show');
        Route::post('/feedback/{feedback}/remove', 'FeedbackController@destroy')->name('feedback.destroy');
        Route::post('/feedback/{feedback}/view', 'FeedbackController@view')->name('feedback.view');
    
    });

});


