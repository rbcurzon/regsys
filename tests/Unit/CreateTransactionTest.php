<?php

use App\Models\Transaction;
use App\Models\TransactionDocument;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

uses(RefreshDatabase::class);


test('user can create many transaction', function () {
    $this->seed();

    $user = User::factory()->create();

    $doc_requests = [1, 2, 3];

    $transaction = Transaction::factory()->create([
        'student_id' => $user->student_id,
    ]);

    foreach ($doc_requests as $doc_request) {
        TransactionDocument::create([
            'transaction_id' => $transaction->id,
            'document_id' => $doc_request,
        ]);
    }
    $this->assertDatabaseCount('transaction_document', count($doc_requests));
    expect($transaction->transactionDocument->count())->toBe(3);
});

it('has document request', function (int $document_id) {
    $this->seed();

    $user = User::factory()->create();

    $transaction = Transaction::factory()->create([
        'student_id' => $user->student_id,
    ]);

    TransactionDocument::create([
        'transaction_id' => $transaction->id,
        'document_id' => $document_id,
    ]);

    expect($transaction->transactionDocument)->not->toBeEmpty();
})->with([1, 2]);
