<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show the form for creating the resource.
     */
    public function create(): never
    {
        abort(404);
    }

    /**
     * Store the newly created resource in storage.
     */
    public function store(Request $request): never
    {
        abort(404);
    }

    /**
     * Display the resource.
     */
    public function show()
    {
        $title = (Auth::user()->isAdmin() ?
            'admin dashboard' :
            Auth::user()->isTreasurer()) ?
            'treasurer dashboard' :
            'student dashboard';

        return view('profile.show', [
            'user' => Auth::user(),
            'title' => $title,
        ]);
    }

    /**
     * Show the form for editing the resource.
     */
    public function edit()
    {
        $title = (Auth::user()->isAdmin() ?
            'admin dashboard' : Auth::user()->isTreasurer()) ?
            'treasurer dashboard' :
            'student dashboard';

        return view('profile.edit', [
            'user' => Auth::user(),
            'title' => $title,
            'courses' => Course::all(),
        ]);
    }

    /**
     * Update the resource in storage.
     */
    public function update(UpdateUserRequest $request)
    {
        $user = User::find(Auth::id());

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->year_level = $request->input('year_level');
        $user->course_id = $request->input('course_id');
        $user->section = $request->input('section');

        $user->save();

        return redirect('/profile');
    }

    /**
     * Remove the resource from storage.
     */
    public function destroy(): never
    {
        abort(404);
    }
}
