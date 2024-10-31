<?php

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

test('belongs to a user', function ()
{
    $user = User::factory()->create();

    $transaction = Transaction::factory()->create([
        'student_id' => $user->student_id,
    ]);

    expect($transaction->user->is($user))->toBeTrue();
});

test('user can delete', function () {
    $user = User::factory()->create();

    $transaction = Transaction::factory()->create([
        'student_id' => $user->student_id,
    ]);

    $transaction_id = $transaction->id;

    $transaction->delete();

    expect($transaction->find($transaction_id))->toBeNull();
});

test('user has many', function ()
{
    $user = User::factory()->create();

    Transaction::truncate();

    $transaction = Transaction::factory(5)->create([
        'student_id' => $user->student_id,
    ]);

    expect($user->transactions->count())->toBe(5);
});

test('pending count is right', function () {
    $count = Transaction::where('status', '=', 'pending')->count();

    $transaction = new Transaction();

    expect($transaction->getPendingCount())->toBe($count);
});
