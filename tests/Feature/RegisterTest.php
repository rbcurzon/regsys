<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('user can register', function () {

    $userData = [
        'student_id' => "2022-10302",
        'email' => 'ronaldcurzon@gmail.com',
        'password' => 'passwordko',
    ];

    $user = User::factory()->create($userData);

    $response = $this->post('/register', $userData);

    $response->assertStatus(302);
    $response->assertRedirect('/');

});
