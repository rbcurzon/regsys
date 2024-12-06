<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses (RefreshDatabase::class);

test('user has department', function () {
    $this->seed();

    $user = User::factory()->create();
    expect($user->course->department)->not()->toBeNull();
});
