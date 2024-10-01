@extends('components.layout')

@section('title', 'Login')
@section('user_id', '')

@section('content')
    <div class="max-w-md mx-auto bg-blue-900 rounded-3xl py-3 shadow-md">
        <div class="px-6 py-4">
        <h2 class="text-lg font-semibold leading-7 text-center text-white border-b border-white pb-3 mb-2">Create a new account</h2>
            <form method="POST" action="/login" class="">
                @csrf
                <div class="grid grid-cols-3 gap-y-6 mb-3 ">
                    {{--student id field start--}}
                    <x-form-field class="col-span-3">
                        <x-form-input type="student_id" id="student_id" name="student_id"
                                      placeholder="2022-10302"
                                      :value="old('student_id')"
                                      required
                        />
                        <x-form-error name="student_id"/>
                    </x-form-field>

                    {{--student id field end--}}

                    <div class="col-span-3 grid grid-cols-2 gap-x-3">
                        {{--first name field start--}}
                        <x-form-field>
                            <x-form-input type="text"
                                          id="first_name"
                                          name="first_name"
                                          placeholder="First name"
                                          required
                            />
                            <x-form-error name="first_name"/>
                        </x-form-field>
                        {{--first name field end--}}

                        {{--last name field start--}}
                        <x-form-field>
                            <x-form-input type="text"
                                          id="last_name"
                                          name="last_name"
                                          placeholder="Last name"
                                          required
                            />
                            <x-form-error name="last_name"/>
                        </x-form-field>
                        {{--last name field end--}}
                    </div>

                    {{--third row start--}}
                    <div class="col-span-3 grid grid-cols-3 gap-x-3">
                        <x-form-field>
                            <x-form-input type="    "
                                          id="year_level"
                                          name="year_level"
                                          placeholder="Year level"
                                          required
                            />
                            <x-form-error name="year_level"/>
                        </x-form-field>

                        <x-form-field>
                            <x-form-input type="text"
                                          id="course"
                                          name="course"
                                          placeholder="Course"
                                          required
                            />
                            <x-form-error name="course"/>
                        </x-form-field>
                        <x-form-field>
                            <x-form-input type="text"
                                          id="section"
                                          name="section"
                                          placeholder="Section"
                                          required
                            />
                            <x-form-error name="section"/>
                        </x-form-field>
                    </div>
                    {{--third row end--}}

                    {{--forth row start--}}
                    <x-form-field class="col-span-3">
                        <x-form-input type="email"
                                      id="email"
                                      name="email"
                                      placeholder="Email"
                                      required
                        />
                    </x-form-field>
                    {{--forth row end--}}

                    {{--fifth row start--}}
                    <x-form-field class="col-span-3">
                        <x-form-input type="password"
                                      id="password"
                                      name="password"
                                      placeholder="Password"
                                      required
                        />
                    </x-form-field>
                    {{--fifth row end--}}

                    {{--sixth row start--}}
                    <x-form-field class="col-span-3">
                        <x-form-input type="password"
                                      id="confirm-password"
                                      name="password-confirmation"
                                      placeholder="Confirm password"
                                      required
                        />
                    </x-form-field>

                    {{--sixth row end--}}


                </div>
                <div class="flex justify-center">
                    {{--                    <x-form-button type="submit" value="Register"--}}
                    {{--                                   class="px-4 py-2 rounded-md bg-blue-600 text-white font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"--}}
                    {{--                                   form="register-form"/>--}}
                    {{--                    <input type="submit" value="" formtarget="register-form">--}}
                    <x-form-button value="Login"
                    />
                </div>
            </form>
        </div>
    </div>

    <form method="get" action="/register" id="register-form">
        @csrf
    </form>
@endsection
