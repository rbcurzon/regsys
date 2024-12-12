<?php

use App\Models\Document;
use App\Models\Transaction;
use App\Models\TransactionDocument;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

//test('user can update documents', function () {
//    $this->seed();
//
//    $user = User::factory()->create();
//
////    create transaction
//    $transaction = Transaction::factory()->create([
//        'student_id' => $user->student_id,
//        'cost' => 0
//    ]);
//
//    $doc_requests = [1, 2];
//
////    create document
//    foreach ($doc_requests as $doc_request) {
//        $transaction->transactionDocument()->create([
//            'transaction_id' => $transaction->id,
//            'document_id' => $doc_request,
//        ]);
//    }
//
//    $transaction->cost = $transaction->getTotalCost();
//    $transaction->save();
//
//    expect(Document::where('document_id', 1)->orWhere('document_id', 2)->sum('cost'))->toBe($transaction->cost);
//    expect($transaction->cost)->not->toBeLessThanOrEqual(0);
//
//    TransactionDocument::where('transaction_id', $transaction->id)->delete();
//
//    $doc_requests = [5, 6];
//
//    foreach ($doc_requests as $doc_request) {
//    $td[] = $transaction->transactionDocument()->create([
//            'transaction_id' => $transaction->id,
//            'document_id' => $doc_request,
//        ]);
//    }
//
//    $transaction->cost = $transaction->getTotalCost();
//    $transaction->save();
//
//    expect(Document::where('document_id', 1)->orWhere('document_id', 2)->sum('cost'))->toBe($transaction->cost);
//    expect($transaction->transactionDocument->count())->toBe(2);
//    $this->assertModelExists($td[0]);
//    $this->assertModelExists($td[1]);
//});
