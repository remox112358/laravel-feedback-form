<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\SignupRequest;

class AuthController extends Controller
{
    /**
     * Display the signup form.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getSignup()
    {
        return view('auth.signup');
    }

    public function postSignup(SignupRequest $request)
    {
        dd($request);
    }

    /**
     * Display the signin form.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getSignin()
    {
        return view('auth.signin');
    }

    public function postSignin(SigninRequest $request)
    {
        dd($request);
    }

    public function getSingout()
    {

    }
}
