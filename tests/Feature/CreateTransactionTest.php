<?php

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

uses(RefreshDatabase::class);

test('create transaction can be rendered', function () {
    $this->seed();

    $user = User::factory()->create();

    $response = $this->actingAs($user)->get("/transactions/create");

    $response->assertSuccessful();
});

test('user can create transaction', function () {
    $this->seed();

    $user = User::factory()->create();

    $document = [0 => 1, 1 => 2, 2 => 3];

    $transactionData = [
        'student_id' => $user->student_id,
        'purpose_id' => 1,
        'documents' => $document,
        'needed_date' => Carbon::tomorrow()->addDay(8),
    ];

    $response = $this->actingAs($user)->post('/transactions', $transactionData);

    $this->assertDatabaseHas('transactions', [
        'student_id' => $user->student_id,
        'needed_date' => Carbon::tomorrow()->addDays(8),
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

test('receipt can be rendered', function () {
    $this->seed();

    $user = User::factory()->create();

    $document = [0 => 1, 1 => 2, 2 => 3];
    $needed_date = Carbon::tomorrow()->addDays(8);
    $transactionData = [
        'student_id' => $user->student_id,
        'purpose_id' => 1,
        'documents' => $document,
        'needed_date' => $needed_date,
    ];

    $response = $this->actingAs($user)->post('/transactions', $transactionData);

    $this->assertDatabaseHas('transactions', [
        'student_id' => $user->student_id,
        'needed_date' => $needed_date,
    ]);

    $response->assertRedirectToRoute('receipt');
});

test('user request with a needed date of with 7 days is invalid', function () {
    $this->seed();

    $user = User::factory()->create();

    $transaction = [
        'student_id' => $user->student_id,
        'id' => '12312'
    ];

    $response = $this->actingAs($user)->post(route('transactions.store', [
            'needed_date' => Carbon::now()->addDays(5)->toDateString(),
            'purpose_id' => 2,
            'documents' => 2,
        ])
    );


    $response->assertInvalid([
        'needed_date',
    ]);
});
