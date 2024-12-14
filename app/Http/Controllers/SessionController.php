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
//        $executed = RateLimiter::attempt(
//            'send-message:' . \request('student_id'),
//            $perMinute = 5,
//            function () {
//            },
//            $decayRate = 120,
//        );


        if (RateLimiter::tooManyAttempts('login:' . \request()->ip(), $perMinute = 3)) {
            $seconds = RateLimiter::availableIn('login:' . \request()->ip());

            session()->put('login_attempt_count', 0);

            return back()->with('toast_error', 'You may try again in ' . $seconds . ' seconds.')->withInput();
        }

        session()->increment('login_attempt_count');

        RateLimiter::increment('login:' . \request()->ip());

// Send message...

//        if (!$executed) {
////            return 'Too many messages sent!';
//        }
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

        session()->put('login_attempt_count', 0);

        request()->session()->regenerate();

        return redirect('/')->with('toast_success', 'You are now logged in');
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/login')->with('toast_error', 'You are now logged out');
    }
}
