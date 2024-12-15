<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{

    public function create()
    {
        return view('auth.login');
    }

    /**
     * @throws ValidationException
     */
    public function store()
    {
        if (session()->missing('login_attempt')) {
            session()->put('login_attempt', 3);
        }

        session()->decrement('login_attempt');

        $executed = RateLimiter::attempt(
            'login:' . \request()->ip(),
            3,
            function () {

            }
        );

        if (!$executed) {
            $seconds = RateLimiter::availableIn('login:' . \request()->ip());

            session()->put('login_attempt', 3);

            return back()->with('toast_error', 'You may try again in ' . $seconds . ' seconds.')->withInput();
        }

        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (!Auth::attempt($attributes)) {
//            throw ValidationException::withMessages([
//                "email" => "Sorry, those credentials are not matched.",
//            ]);
            return back()->with('toast_error', 'Sorry, those credentials are not matched.')->withInput();
        }

        session()->put('login_attempt', 3);

        request()->session()->regenerate();

        return redirect('/')->with('toast_success', 'You are now logged in');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/login')->with('toast_error', 'You are now logged out');
    }
}
