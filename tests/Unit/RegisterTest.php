<?php
use Illuminate\Foundation\Testing\RefreshDatabase;

uses (RefreshDatabase::class);

test('user has department', function () {
    $this->seed();

    $user = \App\Models\User::factory()->create();
    expect($user->course->department)->not()->toBeNull();
});
