<?php

use App\Models\Transaction;
use App\Models\TransactionDocument;
use App\Models\User;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\assertDatabaseHas;

uses(RefreshDatabase::class);

test('user can update his document request', function () {
    $this->seed();

    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

//    create transaction
    $transaction = Transaction::factory()->create([
        'student_id' => $user->student_id,
        'cost' => 0,
        'needed_date' => \Carbon\Carbon::now()->addDays(3)->toDateString(),
        'status' => 'pending',
    ]);
    $doc_requests = [1, 2];
    $t = [];

    //    create document
    foreach ($doc_requests as $doc_request) {
        $t[] = $transaction->transactionDocument()->create([
            'transaction_id' => $transaction->id,
            'document_id' => $doc_request,
        ]);
    }

    $transaction->cost = $transaction->getTotalCost();
    $transaction->save();

    $doc_requests = [
        0 => fake()->randomDigit(),
        1 => fake()->randomDigit(),
        2 => fake()->randomDigit()
    ];
    $response = $this->actingAs($user)->patch('/transactions/' . $transaction->id, [
        'documents' => $doc_requests,
        'needed_date' => $transaction->needed_date,
        'purpose_id' => $transaction->purpose_id,
        'status' => $transaction->status,

    ]);

    $this->assertDatabaseCount('transaction_document', 3);
    $this->assertDatabaseHas('transaction_document', [
        'document_id' => $doc_requests[0],
    ]);
    $this->assertDatabaseHas('transaction_document', [
        'document_id' => $doc_requests[1],
    ]);
    $this->assertDatabaseHas('transaction_document', [
        'document_id' => $doc_requests[2],
    ]);
//    dd($t[0]);
    $this->assertModelMissing($t[0]);
    $this->assertModelMissing($t[1]);
});
