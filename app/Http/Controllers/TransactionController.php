<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Mail\TransactionCreated;
use App\Models\Course;
use App\Models\Document;
use App\Models\Journal;
use App\Models\Purpose;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class TransactionController extends Controller
{
    protected Authenticatable|null|User $user;
    protected Document $document;
    protected Purpose $purpose;
    protected Transaction $transaction;
    protected Journal $journal;

    public function __construct(Transaction $transaction, Document $document, Purpose $purpose, Journal $journal)
    {
        $this->user = Auth::user();
        $this->transaction = $transaction;
        $this->purpose = $purpose;
        $this->document = $document;
        $this->journal = $journal;
    }

    public function index()
    {
        $transactions = null;
        $title = 'student dashboard';
        $on_process_count = -1;
        $released_count = -1;
        $revenue = -1;
        $paid_transactions_count = -1;
        $pending_count = -1;

        if ($this->user->isNormalUser()) {
            $transactions = $this->user->getTransactions();
            $pending_count = $this->user->getPendingCount();
            $released_count = $this->user->getReleasedCount();
            $on_process_count = $this->user->getOnProcessCount();
        }

        if ($this->user->isAdmin() || $this->user->isTreasurer()) {
            $transactions = $this->transaction->getTransactions();
            $on_process_count = $this->transaction->getOnProcessCount();

            if ($this->user->isAdmin()) {
                $pending_count = $this->transaction->getPendingCount();
                $released_count = $this->transaction->getReleasedCount();
                $title = 'admin dashboard';
            } elseif ($this->user->isTreasurer()) {
                $revenue = $this->journal->getTotalDebit();
                $paid_transactions_count = $this->transaction->getPaidTransactionsCount();
                $title = 'treasury dashboard';
            }
        }

        return view('transactions.index', [
            'transactions' => $transactions ?? null,
            'title' => strtoupper($title),
            'user' => $this->user,
            'pending_count' => $pending_count,
            'on_process_count' => $on_process_count,
            'released_count' => $released_count,
            'revenue' => $revenue,
            'paid_transactions_count' => $paid_transactions_count,
        ]);
    }

    public function create(): View|Factory|Application
    {
        return view('transactions.create', [
            'purposes' => $this->purpose->getPurposes(),
            'documents' => $this->document->getDocuments(),
            'user' => $this->user,
            'title' => 'CREATE A TRANSACTION',
        ]);
    }

    function show(Transaction $transaction)
    {


        $user = Auth::user()->isNormalUser() ? $this->user : $transaction->user;

        return view('transactions.show', [
            'transaction' => $transaction,
            'user' => $user,
            'title' => "view",
        ]);
    }

    public
    function store(StoreTransactionRequest $request)
    {

        $transaction = Transaction::create([
            'student_id' => request('student_id'),
            'requested_date' => Carbon::now('Asia/Manila'),
            'needed_date' => request('needed_date'),
            'purpose_id' => request('purpose_id'),
            'document_id' => request('document_id'),
        ]);

        Mail::to($request->user())->queue(new TransactionCreated($transaction));
//        dd(redirect('/receipt')->with(['transaction' => $transaction]));
        return redirect('/receipt')->with(['transaction' => $transaction]);
    }

    public
    function edit(Transaction $transaction)
    {
        $purposes = Purpose::all();
        $documents = Document::all();
        $status = ['processing', 'releasing', 'released', 'rejected'];

        return view('transactions.edit', [
            'transaction' => $transaction,
            'purposes' => $purposes,
            'documents' => $documents,
            'user' => $this->user,
            'status' => $status,
            'bool_map' => ['0' => 'false', '1' => 'true',],
        ]);
    }

    public
    function update(Transaction $transaction, StoreTransactionRequest $request)
    {
        $transaction->update([
            'student_id' => $transaction->student_id,
            'needed_date' => $request->get('needed_date'),
            'purpose_id' => $request->get('purpose_id'),
            'document_id' => $request->get('document_id'),
            'status' => $request->get('status') ?? $transaction->status,
        ]);

        return redirect("/");
    }

    public
    function destroy(Transaction $transaction): Application|Redirector|RedirectResponse
    {
        $transaction->delete();

        return redirect('/');
    }
}
