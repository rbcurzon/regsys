@extends('components.layout')

@section('title', 'Register')
@section('user_id', '')

@section('content')
    <div class="max-w-md mx-auto mt-14 bg-blue-900 rounded-3xl py-3 shadow-md">
        <div class="px-6 py-4">
            <h2 class="text-lg font-semibold leading-7 text-center text-white border-b border-white pb-3 mb-2">Create a
                new account</h2>
            <form action="/register" method="POST">
                @csrf
                <div class="grid grid-cols-6 gap-4 mb-3 ">
                    {{--first row start--}}
                    <x-form-field class="col-span-6">
                        <x-form-input class="w-full"
                                      id="student_id"
                                      name="student_id"
                                      placeholder="Student ID"
                                      :value="old('student_id')"
                                      pattern="^\d{4}-\d{5,}$"
                                      title="2022-10322"
                                      required
                        />
                        <x-form-error name="student_id"/>
                    </x-form-field>
                    {{--first row end--}}

                    {{--second row start--}}
                    <x-form-field class="col-span-6 grid grid-cols-1 sm:grid-cols-2  gap-x-3">
                        <x-form-input type="text"
                                      id="first_name"
                                      name="first_name"
                                      placeholder="First name"
                                      :value="old('first_name')"
                                      required
                        />
                        <x-form-error name="first_name"/>

                        <x-form-input type="text"
                                      id="last_name"
                                      name="last_name"
                                      placeholder="Last name"
                                      :value="old('last_name')"
                                      required
                        />
                        <x-form-error name="last_name"/>
                    </x-form-field>
                    {{--second row end--}}

                    {{--third row start--}}
                    <x-form-field class="col-span-6 grid grid-cols-1 sm:grid-cols-3 gap-x-3 gap-y-6">
                        <x-form-select id="year_level"
                                       name="year_level"
                                       required
                        >
                            <option style="display: none" value="-1">Year level</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </x-form-select>
                        <x-form-error name="year_level"/>

                        <x-form-select id="course_id"
                                       name="course_id"
                                       required
                        >
                            <option style="display: none" value="-1">Course</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->course_id }}">{{ $course->course_name }}</option>
                            @endforeach
                        </x-form-select>
                        <x-form-error name="course_id"/>

                        <x-form-input type="text"
                                      id="section"
                                      name="section"
                                      placeholder="Section"
                                      :value="old('section')"
                        >
                        </x-form-input>
                        <x-form-error name="section"/>
                    </x-form-field>
                    {{--third row end--}}

                    {{--forth row start--}}
                    <x-form-field class="col-span-6">
                        <x-form-input class="w-full"
                                      type="email"
                                      id="email"
                                      name="email"
                                      placeholder="Email"
                                      :value="old('email')"
                                      required
                        />
                        <x-form-error name="first_name"/>
                    </x-form-field>
                    {{--forth row end--}}

                    {{--fifth row start--}}
                    <x-form-field class="col-span-6">
                        <x-form-input class="w-full"
                                      type="password"
                                      id="password"
                                      name="password"
                                      placeholder="Password"
                                      required
                        />
                    </x-form-field>
                    {{--fifth row end--}}

                    {{--sixth row start--}}
                    <x-form-field class="col-span-6">
                        <x-form-input class="w-full"
                                      type="password"
                                      id="confirm-password"
                                      name="password_confirmation"
                                      placeholder="Confirm password"
                                      required
                        />
                    </x-form-field>

                    {{--sixth row end--}}

                    {{--seventh row start--}}
                    <x-form-field class="col-span-6 text-center">
                        <div class="flex justify-center">
                            <x-form-button value="Register"/>
                        </div>
                        <a class="text-white text-sm hover:underline decoration-{white}" href="/login">Log in</a>
                    </x-form-field>
                    {{--seventh row end--}}
                </div>
            </form>
        </div>
    </div>
@endsection
