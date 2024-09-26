<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Document;
use App\Models\Purpose;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use phpDocumentor\Reflection\Types\Null_;
use function Laravel\Prompts\table;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Auth::user()->getTransactions();
//        dd($transactions  );
        return view('transactions.index', ['transactions' => $transactions, 'title' => 'Dashboard', 'user_id' => Auth::user()->id]);
    }

    public
    function create()
    {
        $request_purposes = Purpose::all();
        $documents = Document::all();

        return view('transactions.create', ['request_purposes' => $request_purposes, 'documents' => $documents]);

    }

    public
    function show(Transaction $transaction)
    {
        $transaction->purpose = Purpose::find($transaction->purpose_id)->purpose_name;
        $transaction->type = Document::find($transaction->type_id)->document_name;
        $transaction->program_code = Course::find($transaction->course_id)->code;

//        dd($transaction->attributesToArray());

        return view('transactions.show', ['transaction' => $transaction]);

    }

    public
    function store(Request $request)
    {

//        dd($request->all());

        request()->validate([
            'user_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'year_level' => 'required',
            'course_id' => 'required',
            'section' => 'required',
            'date_needed' => 'required',
            'purpose_id' => 'required | gte:0',
            'type_id' => 'required | gte:0',
        ]);

        Transaction::create([
            'user_id' => request('user_id'),
            'name' => request('first_name') . " " . request('last_name'),
            'year_level' => request('year_level'),
            'course_id' => request('course_id'),
            'section' => request('section'),
            'date_requested' => Carbon::now('Asia/Manila'),
            'date_needed' => request('date_needed'),
            'purpose_id' => request('purpose_id'),
            'type_id' => request('type_id'),
        ]);

        return redirect('/');

    }

    public
    function edit(Transaction $transaction)
    {
//        dd($transaction->attributesToArray());

        $request_purposes = Purpose::all();
        $documents = Document::all();

        // dd($transaction);
        return view('transactions.edit', ['transaction' => $transaction, 'request_purposes' => $request_purposes, 'documents' => $documents]);
    }

    public
    function update(Transaction $transaction, Request $request)
    {
        request()->validate([
            'user_id' => ['required'],
            'year_level' => ['required'],
            'course_id' => ['required'],
            'section' => ['required'],
            'date_requested' => ['required'],
            'date_needed' => ['required'],
            'purpose_id' => ['required'],
            'type_id' => ['required'],
        ]);

        $transaction->update([
            'user_id' => request()->integer('user_id'),
            'year_level' => request('year_level'),
            'course_id' => request('course_id'),
            'section' => request('section'),
            'date_requested' => request('date_requested'),
            'date_needed' => request('date_needed'),
            'purpose_id' => request()->integer('purpose_id'),
            'type_id' => request()->integer('type_id'),
        ]);

        return redirect("/transactions/" . $transaction->id . "/edit");

    }

    public
    function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect('/');
    }
}
