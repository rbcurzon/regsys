<?php

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


test('edit of on-process transaction is forbidden or cannot be rendered', function () {
    $this->seed();

    $user = User::factory()->create();

    Transaction::factory()->create([
        'student_id' => $user->student_id,
    ]);

    $transaction = Transaction::factory()->create([
        'student_id' => $user->student_id,
        'cost' => 0,
    ]);

    $response = $this->actingAs($user)->get('/transactions/' . $transaction->id . '/edit', [
        'documents' => [1],
        'needed_date' => $transaction->needed_date,
        'purpose_id' => $transaction->purpose_id,
        'status' => array_rand(['on process', 'releasing'], 1)
    ]);

    $response->assertForbidden();
});
