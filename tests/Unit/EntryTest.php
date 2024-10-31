<?php

use App\Models\Transaction;
use App\Models\User;
use App\Models\Entry;

test('belongs to a transaction', function () {
    $user = User::factory()->create();
    $transaction = Transaction::factory()->create([
        'user_id' => $user->id,
    ]);
    $entry = Entry::factory()->create(['transaction_id' => $transaction->id]);

    expect($entry->transaction->is($transaction))->toBeTrue();
});
