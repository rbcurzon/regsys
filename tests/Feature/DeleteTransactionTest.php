<?php

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('user can delete a pending transaction', function () {
    $this->seed();

    $user = User::factory()->create();

    $count = Transaction::with('user')->count();

    $transaction = Transaction::factory()->create([
        'student_id' => $user->student_id,
        'status' => 'pending',
    ]);


    $this->assertDatabaseCount('transactions', $count + 1);

    $response = $this->actingAs($user)->delete("/transactions/{$transaction->id}");

    $this->assertDatabaseCount('transactions', $count);

    $this->assertModelMissing($transaction);
});

test('user can not delete a on process transaction', function () {
    $this->seed();

    $user = User::factory()->create();

    $transaction = Transaction::factory()->create([
        'student_id' => $user->student_id,
        'status' => array_rand(['on process', 'for release'], 1),
    ]);

    $response = $this->actingAs($user)->delete("/transactions/{$transaction->id}");

    $response->assertForbidden();
});
