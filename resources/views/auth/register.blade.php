@extends('components.layout')

@section('title', 'Register')

@section('content')
    <!-- Include the Montserrat font from Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">

    <style>
        /* Custom Font Classes */
        .montserrat-light {
            font-family: 'Montserrat', serif;
            font-weight: 300;
        }

        .montserrat-regular {
            font-family: 'Montserrat', serif;
            font-weight: 400;
        }

        .montserrat-medium {
            font-family: 'Montserrat', serif;
            font-weight: 500;
        }

        .montserrat-semibold {
            font-family: 'Montserrat', serif;
            font-weight: 600;
        }

        .montserrat-bold {
            font-family: 'Montserrat', serif;
            font-weight: 700;
        }

        /* Section Titles */
        .section-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #BBBBBB;
            margin-bottom: 0.5rem;
            border-bottom: 1px solid #BBBBBB;
            padding-bottom: 0.5rem;
        }

        .form-container {
            background-color: rgb(0, 0, 85); /* Dark blue background */
        }

        /* Style the register button */
        .register-button {
            background-color: white; /* Change button background to white */
            color: rgb(0, 0, 85); /* Change button text color to dark blue */
        }

        /* Style for login link */
        .login-link {
            color: white;
            font-size: 0.9rem;
        }
    </style>
    <div class="min-h-screen flex items-center justify-center"
         style="background-image: url({{ asset('/images/ccc-bg.jpg') }}); background-size: cover; background-position: center;">
        <div class="max-w-md mx-auto mt-14 form-container rounded-3xl py-3 shadow-md">
            <div class="px-6 py-4">
                <h2 class="text-lg font-semibold leading-7 text-center text-white pb-3 mb-2 montserrat-bold">
                    CREATE A NEW ACCOUNT</h2>

                <form action="/register" method="POST">
                    @csrf
                    <div class="space-y-6">

                        <!-- Personal Information Section -->
                        <div>
                            <h3 class="section-title montserrat-semibold">Personal Information</h3>
                            <div class="grid grid-cols-6 gap-4">
                                <x-form-field class="col-span-6">
                                    <x-form-input class="w-full montserrat-regular"
                                                  id="student_id"
                                                  name="student_id"
                                                  placeholder="Student ID"
                                                  :value="old('student_id')"
                                                  pattern="^\d{4}-\d{5,}$"
                                                  title="2022-10322"
                                                  required
                                    />
                                </x-form-field>

                                <x-form-field class="col-span-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <x-form-input type="text"
                                                  id="first_name"
                                                  name="first_name"
                                                  placeholder="First name"
                                                  :value="old('first_name')"
                                                  class="montserrat-regular"
                                                  required
                                    />
                                    <x-form-error name="first_name"/>

                                    <x-form-input type="text"
                                                  id="last_name"
                                                  name="last_name"
                                                  placeholder="Last name"
                                                  :value="old('last_name')"
                                                  class="montserrat-regular"
                                                  required
                                    />
                                    <x-form-error name="last_name"/>
                                </x-form-field>
                            </div>
                        </div>

                        <!-- Academic Information Section -->
                        <div>
                            <h3 class="section-title montserrat-semibold">Academic Information</h3>
                            <div class="grid grid-cols-6 gap-4">
                                <x-form-field class="col-span-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <x-form-select id="year_level"
                                                   name="year_level"
                                                   class="montserrat-regular"
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
                                                   class="montserrat-regular"
                                                   required
                                    >
                                        <option style="display: none" value="-1">Course</option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->course_id }}">{{ $course->course_name }}</option>
                                        @endforeach
                                        <x-form-error name="course_id"/>
                                    </x-form-select>

                                    <x-form-input type="text"
                                                  id="section"
                                                  name="section"
                                                  placeholder="Ex. 3-CS3"
                                                  :value="old('section')"
                                                  class="montserrat-regular"
                                    />
                                    <x-form-error name="section"/>
                                </x-form-field>
                            </div>
                        </div>

                        <!-- Account Information Section -->
                        <div>
                            <h3 class="section-title montserrat-semibold">Account Information</h3>
                            <div class="grid grid-cols-6 gap-4">
                                <x-form-field class="col-span-6">
                                    <x-form-input class="w-full montserrat-regular"
                                                  type="email"
                                                  id="email"
                                                  name="email"
                                                  placeholder="Email"
                                                  :value="old('email')"
                                                  required
                                    />
                                    <x-form-error name="email"/>
                                </x-form-field>

                                <x-form-field class="col-span-6">
                                    <div x-data="{ showPassword: false }" class="relative">
                                        <input class="w-full montserrat-regular"
                                               :type="showPassword ? 'text' : 'password'"
                                               id="password"
                                               name="password"
                                               placeholder="Password"
                                               required
                                        />
                                        <button
                                            @click="showPassword = !showPassword"
                                            class="absolute inset-y-0 right-0 flex items-center px-2"
                                            type="button"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5"
                                                 x-show="!showPassword">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5"
                                                 x-show="showPassword">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>
                                            </svg>
                                        </button>
                                        <x-form-error name="password"></x-form-error>
                                    </div>
                                </x-form-field>

                                <x-form-field class="col-span-6">
                                    <div x-data="{ showPassword: false }" class="relative">

                                        <input class="w-full montserrat-regular"
                                               :type="showPassword ? 'text' : 'password'"
                                               id="password_confirmation"
                                               name="password_confirmation"
                                               placeholder="Confirm password"
                                               :value="old('password_confirmation')"
                                               required
                                        />
                                        <button
                                            @click="showPassword = !showPassword"
                                            class="absolute inset-y-0 right-0 flex items-center px-2"
                                            type="button"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5"
                                                 x-show="!showPassword">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5"
                                                 x-show="showPassword">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>
                                            </svg>
                                        </button>
                                        <x-form-error name="password"></x-form-error>
                                    </div>
                                </x-form-field>
                            </div>
                        </div>

                        <!-- Register Button -->
                        <x-form-field class="col-span-6 text-center">
                            <div class="flex justify-center">
                                <x-form-button :action="route('register')"
                                               class="register-button montserrat-semibold rounded shadow-md w-full px-4 py-2">
                                    Register
                                </x-form-button>

                            </div>
                            <a class="login-link montserrat-light hover:underline" href="/login">Log in</a>
                        </x-form-field>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
