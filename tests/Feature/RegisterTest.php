<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('register can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('user can register', function () {

    $this->seed();

    $userData = [
        'student_id' => "2022-10309",
        'first_name' => fake()->firstName(),
        'last_name' => fake()->lastName(),
        'year_level' => fake()->numberBetween(1,4),
        'course_id' => fake()->numberBetween(1,7),
        'section' => fake()->numberBetween(1,7),
        'email' => 'ronaldcurzon@gmail.com',
        'password_confirmation' => 'Password1',
        'password' => 'Password1',
    ];

    $response = $this->post('/register', $userData);

    $this->assertAuthenticated();

    $this->assertDatabaseHas('users', [
        'email' => 'ronaldcurzon@gmail.com',
    ]);
});

test('user cannot register using existent email', function () {
    $this->seed();

    $user = User::factory()->create();

    $userData = [
        'student_id' => "2022-10309",
        'first_name' => fake()->firstName(),
        'last_name' => fake()->lastName(),
        'year_level' => fake()->numberBetween(1,4),
        'course_id' => fake()->numberBetween(1,7),
        'section' => fake()->numberBetween(1,7),
        'email' => $user->email,
        'password_confirmation' => 'password',
        'password' => 'password',
    ];

    $response = $this->post('/register', $userData);

    $this->assertGuest();
});
