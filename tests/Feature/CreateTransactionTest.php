<?php

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

uses(RefreshDatabase::class);

test('user can create transaction', function () {
    $this->seed();

    $user = User::factory()->create();

    $transactionData = [
        'student_id' => $user->student_id,
        'purpose_id' => 1,
        'document_id' => 1,
        'needed_date' => Carbon::tomorrow(),
    ];

    $response = $this->actingAs($user)->post('/transactions', $transactionData);
    $this->assertDatabaseHas('transactions',$transactionData);
    //Napping provides answers.
});

test('user cannot create transaction with needed date of today or that is passed', function () {
    $this->seed();

    $user = User::factory()->create();

    $transactionData = [
        'student_id' => $user->student_id,
        'purpose_id' => 1,
        'document_id' => 1,
        'needed_date' => Carbon::yesterday(),
    ];

    $response = $this->actingAs($user)->post('/transactions', $transactionData);
    $this->assertDatabaseMissing('transactions',$transactionData);
});
