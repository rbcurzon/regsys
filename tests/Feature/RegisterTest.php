<?php

use App\Models\User;

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('User\'s invalid format student id cannot register', function () {
    $user = User::factory()->create([
        'student_id' => '2022-1*$42'
    ]);
    $response = $this->actingAs($user)->get('/register');
    $response->assertStatus(200);
});
