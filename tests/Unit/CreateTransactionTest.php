<?php

use App\Models\Document;
use App\Models\Transaction;
use App\Models\TransactionDocument;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use function Pest\Laravel\assertDatabaseCount;

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

test('transaction associates to correct window', function () {
    $this->seed();

    $student_id = User::factory()->create()->student_id;

    $transaction = Transaction::factory()->create([
        'student_id' => $student_id,
    ]);

    $department = $transaction->user->course->department;

    if ($department == 'DTE') {
        expect($transaction->window())->toBe(1);
    } else if ($department == 'DCI') {
        expect($transaction->window())->toBe(2);
    } else if ($department == 'DBA') {
        expect($transaction->window())->toBe(3);
    } else if ($department == 'DAS') {
        expect($transaction->window())->toBe(4);
    }
});

test('transaction can be recorded on journal', function () {
    $this->seed();

    $user = User::factory()->create();

    $transaction = Transaction::factory()->create([
        'student_id' => User::factory()->create()->student_id,
        'cost' => 50,
    ]);

    $response = $this->actingAs($user)
        ->post(route('journals.store', ['transaction_id' => $transaction->id, 'student_id' => $user->student_id, 'cost' => $transaction->cost]));

    $this->assertDatabaseCount('journals', 2);
});

test('user can request two copies of a document', function () {
    $this->seed();

    $document_id = 2;
    $quantity = 2;

    $transaction = Transaction::factory()->create([
    ]);

    $transaction_document = TransactionDocument::factory()->create([
        'transaction_id' => $transaction->id,
        'document_id' => $document_id,
        'quantity' => $quantity,
        'price' => $quantity * Document::find($document_id)->cost,
    ]);

//    $transaction_document->computePrice();

    $total = Document::find($document_id)->cost * $transaction_document->quantity;

    $transaction->setCost($total);

    expect($transaction->cost)->toBe($total);
});

test('user can request a document and multiple copies of another document', function () {
    $this->seed();

    $document_id = 2;
    $quantity = 2;

    $transaction = Transaction::factory()->create([
    ]);

    TransactionDocument::factory()->create([
        'transaction_id' => $transaction->id,
        'document_id' => $document_id,
        'quantity' => $quantity,
        'price' => $quantity * Document::find($document_id)->cost,
    ]);

    $document_id = 1;
    $quantity = 1;

    TransactionDocument::factory()->create([
        'transaction_id' => $transaction->id,
        'document_id' => $document_id,
        'quantity' => $quantity,
        'price' => $quantity * Document::find($document_id)->cost,
    ]);

    $transaction->setCost($transaction->transactionDocument->sum('price'));

//    dd($transaction->cost);
});
