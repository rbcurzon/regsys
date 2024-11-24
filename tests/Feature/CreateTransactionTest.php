<?php

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

uses(RefreshDatabase::class);

test('user can create transaction', function () {
    $this->seed();

    $user = User::factory()->create();

    $document = [0 => 1, 1 => 2, 2 => 3];

    $transactionData = [
        'student_id' => $user->student_id,
        'purpose_id' => 1,
        'documents' => $document,
        'needed_date' => Carbon::tomorrow(),
    ];

    $response = $this->actingAs($user)->post('/transactions', $transactionData);
    $this->assertDatabaseHas('transactions', [
        'student_id' => $user->student_id,
        'needed_date' => Carbon::tomorrow(),
    ]);
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
    $this->assertDatabaseMissing('transactions', $transactionData);
});

test('user cannot create transaction with a needed date of greater than seven days', function () {
    $this->seed();

    $user = User::factory()->create();

    $document = [0 => 1, 1 => 2, 2 => 3];

    $transactionData = [
        'student_id' => $user->student_id,
        'purpose_id' => 1,
        'documents' => $document,
        'needed_date' => Carbon::today()->addDays(8),
    ];


    $response = $this->actingAs($user)->post('/transactions', $transactionData);

    $this->assertDatabaseMissing('transactions', [
        'student_id' => $user->student_id,
        'needed_date' => Carbon::today()->addDays(8),
    ]);
});

