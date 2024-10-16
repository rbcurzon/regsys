@extends('components.layout')

@section('title', 'Login')
@section('user_id', '')

@section('content')
    <div class="max-w-md mx-auto mt-36 bg-blue-900 rounded-3xl py-3 shadow-md">
        <div class="px-6 py-4">
            <h2 class="text-lg font-semibold leading-7 text-center text-white border-b border-white pb-3 mb-2">
                Login</h2>
            <form method="POST" action="/login" class="">
                @csrf
                <div class="grid grid-cols-1 gap-4 mb-3">
                    <x-form-field>
                        <x-form-input type="email" id="email" name="email" placeholder="Email"
                                      :value="old('email')"
                                      required
                        />
                    </x-form-field>
                    <x-form-field>
                        <x-form-input type="password" id="password" name="password" placeholder="Password"
                                      required/>
                        <x-form-error name="email"/>
                    </x-form-field>
                    <x-form-field class="text-center ">
                        <div class="flex flex-col">
                            <x-form-button value="Login"/>
                        </div>
                        <a class="text-white text-sm hover:underline decoration-{white}" href="/register">Sign
                            up</a>
                    </x-form-field>
                </div>
            </form>
        </div>
    </div>
    <form method="get" action="/register" id="register-form">
        @csrf
    </form>
@endsection
