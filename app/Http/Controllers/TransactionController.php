<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Document;
use App\Models\Purpose;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TransactionController extends Controller
{
    public function index()
    {
        if (Auth::guest())
        {
            return redirect('/login');
        }
        $transactions = Transaction::with('user_id')->latest();

        return view ('transactions.index', [
            'transactions' => Transaction::all()
        ]);

    }
    public function create()
    {
        $request_purposes = Purpose::all();
        $documents = Document::all();

        return view('transactions.create', ['request_purposes' => $request_purposes, 'documents' => $documents]);

    }

    public function show(Transaction $transaction){
        $transaction->purpose = Purpose::find($transaction->purpose_id)->name;
        $transaction->type = Document::find($transaction->type_id)->name;
        $transaction->program_code = Course::find($transaction->course_id)->course_code;
        return view('transactions.show', ['transaction' => $transaction]);

    }
    public function store(Request $request){
        request()->validate([
            'user_id' => 'required',
            'name' => 'required',
            'year_level' => 'required',
            'course_id' => 'required',
            'section_id' => 'required',
            'date_requested' => 'required',
            'date_needed' => 'required',
            'purpose_id' => 'required',
            'type_id' => 'required',
        ]);

        Transaction::create([
            'user_id' => request('user_id'),
            'name' => request('name'),
            'year_level' => request('year_level'),
            'course_id' => request('course_id'),
            'section_id' => request('section_id'),
            'date_requested' => request('date_requested'),
            'date_needed' => request('date_needed'),
            'purpose_id' => request('purpose_id'),
            'type_id' => request('type_id'),
        ]);

        return redirect('/transactions');

    }

    public function edit(Transaction $transaction)
    {

        //        Gate::authorize('edit-transaction', $transaction);

        $request_purposes = Purpose::all();
        $documents = Document::all();

        // dd($transaction);
        return view('transactions.edit', ['transaction' => $transaction, 'request_purposes' => $request_purposes, 'documents' => $documents]);
    }

    public function update(Transaction $transaction, Request $request)
    {
        request()->validate([
            'user_id' => ['required'],
            'name' => ['required'],
            'year_level' => ['required'],
            'course_id' => ['required'],
            'section_id' => ['required'],
            'date_requested' => ['required'],
            'date_needed' => ['required'],
            'purpose_id' => ['required'],
            'type_id' => ['required'],
        ]);

        $transaction->update([
            'user_id' => request()->integer('user_id'),
            'name' => request('name'),
            'year_level' => request('year_level'),
            'course_id' => request('course_id'),
            'section_id' => request('section_id'),
            'date_requested' => request('date_requested'),
            'date_needed' => request('date_needed'),
            'purpose_id' => request()->integer('purpose_id'),
            'type_id' => request()->integer('type_id'),
        ]);

        return redirect("/transactions/" . $transaction->id . "/edit");

    }
    public function destroy(Transaction $transaction){
        $transaction->delete();

        return redirect('/transactions');
    }
}
