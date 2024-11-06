<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test("login can be rendered", function () {

    $this->seed();

    $response = $this->get("/login");

    $response->assertStatus(200);
});

test("user can authenticate using the login screen", function () {
    $user = User::factory()->create();

    $this->seed();

    $response = $this->post("/login", [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticatedAs($user);
    $response->assertRedirect("/");
});

test('user cannot authenticate with wrong password', function () {
    $user = User::factory()->create();

    $response = $this->post("/login", [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

