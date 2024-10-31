<?php

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('user can create transaction', function () {

    $this->seed();

    $userData = [
        'student_id' => "2022-10302",
        'email' => 'ronaldcurzon@gmail.com',
        'password' => 'passwordko',
    ];

    $transactionData = [
        'student_id' => "2022-10302",
        'purpose_id' => 1,
        'document_id' => 1,
        'needed_date' => \Illuminate\Support\Carbon::tomorrow(),
    ];

    $user = User::factory()->create($userData);

    $response = $this->actingAs($user)->post('/transactions', $transactionData);
    $response->assertSee('Proceed to WINDOW 1 to claim your request on: ' . $transactionData['needed_date']);
    $response->assertStatus(200);
    //Napping provides answers.
});
