<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterUserController extends Controller
{
    public function create()
    {
        $courses = Course::all();
        return view('auth.register', ['courses' => $courses]);
    }

    public function store()
    {
//        dd(request()->all());

        $attributes = request()->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'year_level' => ['required'],
            'course_id' => ['required'],
            'section' => ['required'],
            'password' => [Password::min(8), "confirmed"],

        ]);

        $user = User::create($attributes);

        Auth::login($user);

        return redirect("/");
    }
}
