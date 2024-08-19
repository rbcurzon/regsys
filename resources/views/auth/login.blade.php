<x-layout>
    <form method="POST" action="/login">
        @csrf
        <h2 class="text-base font-semibold leading-7 text-gray-900">Register</h2>
        <div class="col">
            <x-form-field>
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <x-form-input type="email" id="email" name="email" placeholder="john@mail.com" :value="old('email')" required />
                <x-form-error name="email"/>
            </x-form-field>
            <x-form-field>
                <label for="password" class="col-sm-3 col-form-label">Password</label>
                <x-form-input type="password" id="password" name="password" placeholder="password" required />
                <x-form-error name="password"/>
            </x-form-field>
        </div>
        <div class="d-flex justify-content-end">
            <x-form-button type="submit" value="Register"/>
        </div>
    </form>
</x-layout>
