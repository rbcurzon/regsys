<?php

use App\Models\User;

test('belongs to a user', function () {
    $user = User::factory()->create();
    $transaction = \App\Models\Transaction::factory()->create([
        'user_id' => $user->id,
    ]);

    expect($transaction->user->is($user))->toBeTrue();
});

test('user has', function () {
    $user = User::factory()->create();
    $transaction = \App\Models\Transaction::factory()->create([
        'user_id' => $user->id,
    ]);

    expect($user->transaction->count())->toBe(1);
});


test('user has many', function () {
    $user = User::factory()->create();
    $transaction = \App\Models\Transaction::factory(5)->create([
        'user_id' => $user->id,
    ]);

    expect($user->transaction->count())->toBe(5);
});

test('can destroy', function () {
    $user = User::factory()->create();

});
