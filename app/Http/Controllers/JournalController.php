<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class JournalController extends Controller
{
    public function create()
    {

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'or_number' => 'required | unique:App\Models\Transaction,or_number',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $transaction = Transaction::findOrFail($request->get('transaction_id'));

        $transaction->update([
            'is_paid' => true,
            'or_number' => $request->get('or_number'),
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

//        session()->flash('success', 'Transaction marked as paid successfully.');
//
        toast('You marked a transaction as paid.','success');
        return redirect(URL::previous());
    }
}
