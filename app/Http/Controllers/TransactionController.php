<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
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
use Illuminate\Support\Facades\Route;

/**
 *
 */
class TransactionController extends Controller
{
    /**
     * @var Authenticatable|User|null
     */
    protected Authenticatable|null|User $user;
    /**
     * @var Document
     */
    protected Document $document;
    /**
     * @var Purpose
     */
    protected Purpose $purpose;
    /**
     * @var Transaction
     */
    protected Transaction $transaction;
    protected Journal $journal;

    /**
     * @param Transaction $transaction
     * @param Document $document
     * @param Purpose $purpose
     */
    public function __construct(Transaction $transaction, Document $document, Purpose $purpose, Journal $journal)
    {
        $this->user = Auth::user();
        $this->transaction = $transaction;
        $this->purpose = $purpose;
        $this->document = $document;
        $this->journal = $journal;
    }

    /**
     * @return Factory|View|Application
     */
    public function index()
    {
        /**
         * If current user is admin get all transaction, else
         * get transactions of current user.
         */

        $transactions = $this->user->isAdmin() || $this->user->isTreasurer() ?
            $this->transaction->getTransactions() :
            $this->user->getTransactions();

        $pending_count = $this->user->isAdmin() ?
            $this->transaction->getPendingCount() :
            $this->user->getPendingCount();

        $on_process_count = $this->user->isAdmin() || $this->user->isTreasurer() ?
            $this->transaction->getOnProcessCount() :
            $this->user->getOnProcessCount();

        $released_count = $this->user->isAdmin() ?
            $this->transaction->getReleasedCount() :
            $this->user->getReleasedCount();

        $revenue = $this->user->isTreasurer() ?
            $this->journal->getTotalDebit() :
            -1;

        $title = $this->user->isAdmin() ? 'admin dashboard'
            : ($this->user->isTreasurer() ? 'treasury dashboard'
                : 'Student Dashboard');

        return view('transactions.index', [
            'transactions' => $transactions,
            'title' => strtoupper($title),
            'user' => $this->user,
            'pending_count' => $pending_count,
            'on_process_count' => $on_process_count,
            'released_count' => $released_count,
            'revenue' => $revenue,
        ]);
    }

    /**
     * @return View|Factory|Application
     */
    public function create(): View|Factory|Application
    {
        return view('transactions.create', [
            'purposes' => $this->purpose->getPurposes(),
            'documents' => $this->document->getDocuments(),
            'user' => $this->user,
            'title' => 'CREATE A TRANSACTION'
            ]);
    }

    /**
     * @param Transaction $transaction
     * @return Factory|View|Application
     */
    function show(Transaction $transaction)
    {
        $user = Auth::user()->isNormalUser() ? $this->user : $transaction->user;

        return view('transactions.show', [
            'transaction' => $transaction,
            'user' => $user,
            'title' => "view",
        ]);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
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

    return view('receipt', ['transaction' => $transaction]);
    }

    /**
     * @param Transaction $transaction
     * @return Factory|View|Application
     */
    public
    function edit(Transaction $transaction)
    {
        $purposes = Purpose::all();
        $documents = Document::all();
        $status = ['processing', 'releasing', 'released', 'cancelled'];

        return view('transactions.edit', [
            'transaction' => $transaction,
            'purposes' => $purposes,
            'documents' => $documents,
            'user' => $this->user,
            'status' => $status,
            'bool_map' => ['0'=>'false', '1'=>'true',],
        ]);
    }

    /**
     * @param Transaction $transaction
     * @param StoreTransactionRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public
    function update(Transaction $transaction, StoreTransactionRequest $request)
    {

//        dd($request->all());

        $transaction->update([
            'needed_date' => $request->get('needed_date'),
            'purpose_id' => $request->get('purpose_id'),
            'document_id' => $request->get('document_id'),
            'status' => $request->get('status'),
        ]);

        return redirect("/");
    }

    /**
     * @param Transaction $transaction
     * @return Application|RedirectResponse|Redirector
     */
    public
    function destroy(Transaction $transaction): Application|Redirector|RedirectResponse
    {
        $transaction->delete();

        return redirect('/');
    }
}
