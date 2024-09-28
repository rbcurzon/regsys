<?php

use App\Models\User;

test('example', function () {
    expect(true)->toBeTrue();
});

test('user can register', function () {
    $user = User::factory()->create();

    expect(User::find($user->id)== true)->toBeTrue();
});
