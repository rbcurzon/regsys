<?php

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

test('belongs to a user', function () {

    $user = User::where('student_id', '=', '2022-30503')->firstOrFail();
    $transaction = Transaction::factory()->create([
        'student_id' => $user->student_id,
    ]);

    expect($transaction->user->is($user))->toBeTrue();
});

test('user can delete', function () {
    $user = User::where('student_id', '=', '2022-30503')->firstOrFail();

    $transaction = Transaction::factory()->create([
        'student_id' => $user->student_id,
    ]);

    $transaction_id = $transaction->id;

    $transaction->delete();

    expect($transaction->find($transaction_id))->toBeNull();
});


test('user has many', function () {
    $user = User::where('student_id', '=', '2022-30503')->firstOrFail();

    Transaction::truncate();

    $transaction = Transaction::factory(5)->create([
        'student_id' => $user->student_id,
    ]);

    expect($user->transactions->count())->toBe(5);
});
