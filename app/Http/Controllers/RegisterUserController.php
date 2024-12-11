<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegisterUserRequest;
use App\Models\Course;
use App\Models\User;
use Dotenv\Validator;
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
        return view('auth.register', ['courses' => Course::with('users')->get()]);
    }

    public function store(Request $request)
    {

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'student_id' => ['required', 'string', 'regex:/^\d{4}-\d{5,}$/', 'unique:users'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'year_level' => ['required'],
            'course_id' => ['required', 'gte:0'], //gte = greater that or equal
            'section' => ['required'],
            'password' => [Password::min(8)->mixedCase()->numbers(), "confirmed", "required"],
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', [$validator->messages()->all()])->withInput();
        }

        $user = User::create($validator->validated());

        Auth::login($user);

        return redirect("/")->with('toast_success', 'You successfully registered your account.')->autoClose(5000);
    }
}
