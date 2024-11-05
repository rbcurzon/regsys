<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

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
        'password_confirmation' => 'password',
        'password' => 'password',
    ];

    $response = $this->post('/register', $userData);

    $this->assertAuthenticated();

    $this->assertDatabaseHas('users', [
        'email' => 'ronaldcurzon@gmail.com',
    ]);
});
