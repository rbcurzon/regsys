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
        return view('auth.register', [
            'courses' => Course::with('users')->get(),
            'year_levels' => [1,2,3,4],
        ]);
    }

    public function store(Request $request)
    {

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(),
            [
                'student_id' => ['required', 'string', 'regex:/^\d{4}-\d{5,}$/', 'unique:users'],
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'year_level' => ['required', 'gte:0', 'max:4'],
                'course_id' => ['required', 'gte:0'], //gte = greater that or equal
                'section' => ['required'],
                'password' => [Password::min(8)->mixedCase()->numbers()->symbols(), "confirmed", "required"],
            ],
            $messages = [
                'student_id.required' => 'Student ID is required',
                'student_id.regex' => 'Student ID is invalid',
                'student_id' => 'Student ID is already registered',
                'first_name' => 'First Name is required',
                'last_name.required' => 'Last Name is required',
                'email.required' => 'Email is required',
                'email.email' => 'Email is invalid',
                'email.unique' => 'Email already exists',
                'year_level.gte' => 'Year level is required',
                'course_id.gte' => 'Course is required',
                'section.required' => 'Section is required',
                'password.required' => 'Password is required',
                'password.min' => 'Password must be at least 8 characters',
                'password.confirmed' => 'Password does not match',
                'password.regex' => 'Password is invalid',
            ]);

        if ($validator->fails()) {
            return back()->with('toast_error', [$validator->messages()->all()])->withInput();
        }

        $user = User::create($validator->validated());

        Auth::login($user);

        return redirect("/")->with('toast_success', 'You successfully registered your account.');
    }
}
