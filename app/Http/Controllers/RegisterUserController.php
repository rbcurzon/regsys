<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegisterUserRequest;
use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use function Pest\Laravel\get;

class RegisterUserController extends Controller
{
    public function create()
    {
//        dd(request());
        return view('auth.register', ['courses' => Course::with('users')->get()]);
    }

    public function store(StoreRegisterUserRequest $request)
    {
        $attributes = $request->validated();
        $user = User::create($attributes);

        Auth::login($user);

        return redirect("/");
    }
}
