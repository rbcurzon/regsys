<?php

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('belongs to a user', function () {
    $this->seed();

    $user = User::factory()->create();

    $transaction = Transaction::factory()->create([
        'student_id' => $user->student_id,
    ]);

    expect($transaction->user->is($user))->toBeTrue();
});

test('user can delete', function () {
    $this->seed();

    $user = User::factory()->create();

    $transaction = Transaction::factory()->create([
        'student_id' => $user->student_id,
    ]);

    $transaction_id = $transaction->id;

    $transaction->delete();

    expect($transaction->find($transaction_id))->toBeNull();
});

test('user has many', function () {
    $this->seed();

    $user = User::factory()->create();

    $transaction = Transaction::factory(5)->create([
        'student_id' => $user->student_id,
    ]);

    expect($user->transactions->count())->toBe(5);
});

