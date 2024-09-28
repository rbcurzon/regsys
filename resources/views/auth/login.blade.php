@extends('components.layout')

@section('title', 'Login')
@section('user_id', '')

@section('content')
    <div class="max-w-md mx-auto bg-blue-900 rounded-3xl">
        <div class="px-6 py-4">
            <form method="POST" action="/login" class="space-y-4">
                @csrf
                {{--                <h2 class="text-lg font-semibold leading-7 text-white">Register</h2>--}}
                <div class="grid grid-cols-1 gap-4 mb-3">
                    <x-form-field>
                        <label for="email" class="text-sm font-medium text-white">Email</label>
                        <x-form-input type="email" id="email" name="email" placeholder="john@mail.com"
                                      :value="old('email')"
                                      required
                                      class="w-full border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-600"/>
                    </x-form-field>
                    <x-form-field>
                        <label for="password" class="text-sm font-medium text-white">Password</label>
                        <x-form-input type="password" id="password" name="password" placeholder="password" required
                                      class="w-full border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-600"/>
{{--                        <x-form-error name="password" class="italic text-red"/>--}}
                    </x-form-field>
                        <x-form-error name="email"/>
                </div>
                <div class="flex justify-center">
                    {{--                    <x-form-button type="submit" value="Register"--}}
                    {{--                                   class="px-4 py-2 rounded-md bg-blue-600 text-white font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"--}}
                    {{--                                   form="register-form"/>--}}
                    {{--                    <input type="submit" value="" formtarget="register-form">--}}
                    <x-form-button value="Login"
                                   class="px-4 py-2 text-white font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    />
                </div>
            </form>
        </div>
    </div>
    <form method="get" action="/register" id="register-form">
        @csrf
    </form>
@endsection
