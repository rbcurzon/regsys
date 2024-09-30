@extends('components.layout')

@section('title', "register")

@section('user_id', '')

@section('content')
{{--<x-layout>--}}
    <div class="max-w-md mx-auto">
        <form method="POST" action="/register" class="space-y-4">
            @csrf

            <h2 class="text-lg font-semibold leading-7 text-gray-900">Register</h2>
            <div class="grid grid-cols-3 gap-4">
                {{--student id start --}}
                <x-form-field class="col-span-full">
                    <label for="student_id" class="text-sm font-medium text-gray-700">Student id</label>
                    <x-form-input type="student_id" id="student_id" name="student_id" placeholder="2022-10302"
                                  :value="old('student_id')"
                                  required
                                  class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-600"/>
                    <x-form-error name="student_id"/>
                </x-form-field>

                <x-form-field class="col-span-full">
                    <label for="first_name" class="text-sm font-medium text-gray-700">First name</label>
                    <x-form-input type="first_name" id="first_name" name="first_name" placeholder="John"
                                  :value="old('first_name')"
                                  required
                                  class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-600"/>
                    <x-form-error name="first_name"/>
                </x-form-field>
                {{--student id end --}}

                {{--last name start --}}
                <x-form-field class="col-span-full">
                    <label for="last_name" class="text-sm font-medium text-gray-700">Last name</label>
                    <x-form-input type="last_name" id="last_name" name="last_name" placeholder="John"
                                  :value="old('last_name')"
                                  required
                                  class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-600"/>
                    <x-form-error name="last_name"/>
                </x-form-field>
                {{--last name end --}}

                {{--year level start --}}
                <x-form-field class="col-span-1">
                    <label for="year_level" class="text-sm font-medium text-gray-700">Year level</label>
                    <select type="year_level" id="year_level" name="year_level" required
                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-600">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                    <x-form-error name="year_level"/>
                </x-form-field>
                {{--year level end --}}

                {{--course start --}}
                <x-form-field class="col-span-1">
                    <label for="course" class="text-sm font-medium text-gray-700">Course</label>
                    <select id="course" name="course_id"
                            required
                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-600">
                        @foreach($courses as $course)
                            <option value="{{ $course->course_id }}">{{ $course->code }}</option>
                        @endforeach

                        <option>BSCS</option>
                        <option>BSIT</option>
                        <option>Other</option>
                    </select>
                    <x-form-error name="course"/>
                </x-form-field>
                {{--course end --}}

                {{--section start --}}
                <x-form-field class="col-span-1">
                    <label for="section" class="text-sm font-medium text-gray-700">Section</label>
                    <x-form-input type="text" id="section" name="section" placeholder="3-CS1"
                                  :value="old('section')"
                                  required
                                  class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-600"/>
                    {{--                    <x-form-error name="section"/>--}}
                </x-form-field>
                {{--section end --}}

                {{--email start --}}
                <x-form-field class="col-span-full">
                    <label for="email" class="text-sm font-medium text-gray-700">Email</label>
                    <x-form-input type="email" id="email" name="email" placeholder="john@mail.com" :value="old('email')"
                                  required
                                  class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-600"/>
                    <x-form-error name="email"/>
                </x-form-field>
                {{--email start --}}

                {{--password start--}}
                <x-form-field class="col-span-3">
                    <label for="password" class="text-sm font-medium text-gray-700">Password</label>
                    <x-form-input type="password" id="password" name="password" placeholder="password" required
                                  class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-600"/>
                    <x-form-error name="password"/>
                </x-form-field>
                {{--password start--}}


                {{--confirm-password start--}}
                <x-form-field class="col-span-3">
                    <label for="confirm-password" class="text-sm font-medium text-gray-700">Confirm password</label>
                    <x-form-input type="password" id="confirm-password" name="password_confirmation" placeholder="confirm-password" required
                                  class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-600"/>
                    <x-form-error name="confirm-password"/>
                </x-form-field>
                {{--password start--}}

            </div>
            <div class="flex justify-end gap-2">
                <x-form-button type="submit" value="Register"
                               class="px-4 py-2 rounded-md bg-blue-600 text-white font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                />
                {{--                <input type="submit" value="" formtarget="register-form">--}}
                <x-form-button type="submit" value="Login"
                               class="px-4 py-2 rounded-md bg-blue-600 text-white font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                               form="login-form"
                />
            </div>

        </form>
    </div>
    <form method="get" action="/login" id="login-form">
        @csrf
    </form>
@endsection
{{--</x-layout>--}}
