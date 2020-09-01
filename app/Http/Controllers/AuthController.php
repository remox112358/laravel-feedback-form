<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\SigninRequest;

use App\Models\User;

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

    /**
     * Create new user. Authorize automatically.
     *
     * @param SignupRequest $request
     * @return void
     */
    public function postSignup(SignupRequest $request)
    {
        $user = User::create([
            'email'    => $request->input('email'),
            'name'     => $request->input('name'),
            'password' => bcrypt($request->input('password'))
        ]);

        Auth::loginUsingId($user->id);

        return redirect()
                ->route('home')
                ->with('success', 'Вы успешно зарегистрировались');
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

    /**
     * Signin into account.
     *
     * @param SigninRequest $request
     * @return void
     */
    public function postSignin(SigninRequest $request)
    {
        if (! Auth::attempt($request->only('email', 'password'), $request->has('remember'))) {
            return redirect()
                    ->back()
                    ->with('danger', 'Неправильный логин или пароль.');
        }

        return redirect()
                ->route('home')
                ->with('success', 'Вы успешно авторизовались.');
    }

    /**
     * Logout from account.
     *
     * @return void
     */
    public function getSignout()
    {
        Auth::logout();

        return redirect()
                ->route('home');
    }
}
