<x-layout>
    <form method="POST" action="/register">
        @csrf
        <h2 class="text-base font-semibold leading-7 text-gray-900">Register</h2>
        <div class="col">
            <x-form-field>
                <label for="first_name" class="col-sm-3 col-form-label">First Name</label>
                <x-form-input type="text" id="first_name" name="first_name" placeholder="John" required />
                <x-form-error name="first name"/>
            </x-form-field>
            <x-form-field>
                <label for="last_name" class="col-sm-3 col-form-label">Last Name</label>
                <x-form-input type="text" id="last_name" name="last_name" placeholder="Doe" required />
                <x-form-error name="last name"/>
            </x-form-field>
            <x-form-field>
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <x-form-input type="email" id="email" name="email" placeholder="john@mail.com" required />
                <x-form-error name="email"/>
            </x-form-field>
            <x-form-field>
                <label for="password" class="col-sm-3 col-form-label">Password</label>
                <x-form-input type="password" id="password" name="password" placeholder="password" required />
                <x-form-error name="password"/>
            </x-form-field>
            <x-form-field>
                <label for="confirm_password" class="col-sm-3 col-form-label">Confirm Password</label>
                <x-form-input type="password" id="confirm_password" name="password_confirmation" placeholder="confirm password" required />
                <x-form-error name=""/>
            </x-form-field>
        </div>
        <div class="d-flex justify-content-end">
            <x-form-button type="submit" value="Register"/>
        </div>
    </form>
</x-layout>
