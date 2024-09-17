<x-layout>
    <div class="w-3/6 mx-auto">
        <form method="POST" action="/login" class="space-y-4">
            @csrf

            <h2 class="text-lg font-semibold leading-7 text-gray-900">Register</h2>
            <div class="grid grid-cols-1 gap-4">
                <x-form-field>
                    <label for="email" class="text-sm font-medium text-gray-700">Email</label>
                    <x-form-input type="email" id="email" name="email" placeholder="john@mail.com" :value="old('email')"
                                  required
                                  class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-600"/>
                    <x-form-error name="email"/>
                </x-form-field>
                <x-form-field>
                    <label for="password" class="text-sm font-medium text-gray-700">Password</label>
                    <x-form-input type="password" id="password" name="password" placeholder="password" required
                                  class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-600"/>
                    <x-form-error name="password"/>
                </x-form-field>
            </div>
            <div class="flex justify-end">
                <x-form-button type="submit" value="Register"
                               class="px-4 py-2 rounded-md bg-blue-600 text-white font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                               form="register-form"/>
                <input type="submit" value="" formtarget="register-form">
                <x-form-button type="submit" value="Login"
                               class="px-4 py-2 rounded-md bg-blue-600 text-white font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                />
            </div>

        </form>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <form method="get" action="/register" id="register-form">


    </form>
</x-layout>
