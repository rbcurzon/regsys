<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class JournalController extends Controller
{
    public function create()
    {

    }

    public function store(Request $request)
    {
        $transaction = Transaction::findOrFail($request->get('transaction_id'));

        $transaction->update([
            'is_paid' => true,
        ]);

        $transaction->save();

        $description = "Provide service for student " . $request->get('student_id');

        DB::table('financial_transactions')->insert([
            'financial_transaction_id' => $request->get('transaction_id'),
            'description' => $description,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        //debit cash
        Journal::create([
            'financial_transaction_id' => $request->get('transaction_id'),
            'account_id' => 1, // account_id 1 is for cash,
            'cost' => $request->get('cost'),
            'is_credit' => false,
        ]);

        //credit services revenues
        Journal::create([
            'financial_transaction_id' => $request->get('transaction_id'),
            'account_id' => 2, // account_id 1 is for services revenue,
            'cost' => $request->get('cost'),
            'is_credit' => true,
        ]);

        return redirect(URL::previous());
    }
}
