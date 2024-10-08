<?php

use App\Models\User;

test('user to long student id cannot register', function () {
    $user = User::factory()->create([
        'student_id' => '2022-A22*d'
    ]);
    expect(User::find($user->id) == false)->toBeTrue();
});

test('user can register', function () {
    $user = User::factory()->create([
        'student_id' => '2022-10302'
    ]);

    expect(User::find($user->id) == true)->toBeTrue();
});
