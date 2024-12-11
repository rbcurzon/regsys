<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        request()->session()->regenerate();

        return redirect('/')->with('toast_success', 'You are now logged in');
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/login');
    }
}
