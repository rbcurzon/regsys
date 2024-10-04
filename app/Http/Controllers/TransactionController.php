<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Document;
use App\Models\Purpose;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class TransactionController extends Controller
{
    /**
     * @var User
     */
    protected User $user;
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

    /**
     * @param User $users
     * @param Document $document
     * @param Purpose $purpose
     * @param Transaction $transaction
     */
    public function __construct(User $user, Transaction $transaction, Document $document, Purpose $purpose)
    {
        $this->user = $user;
        $this->document = $document;
        $this->purpose = $purpose;
        $this->transaction = $transaction;
    }

    /**
     * @return Factory|View|Application
     */
    public function index()
    {
        // If current user is admin get all transaction, else
        // get transactions of current user.
        $transactions = Auth::user()->is_admin || Auth::user()->is_treasurer ?
            $this->transaction->getTransactions() :
            $this->user->getTransactions();

        $user = Auth::user();

        $user->course = Course::find($user->id)->code;
        $pending_count = Auth::user()->is_admin || Auth::user()->is_treasurer ?
            $this->transaction->getPendingCount() :
            $this->user->getPendingCount();

        return view('transactions.index', [
            'transactions' => $transactions,
            'title' => 'Dashboard',
            'user' => $user,
            'pending_count' => $pending_count,
        ]);
    }

    /**
     * @return View|Factory|Application
     */
    public function create(): View|Factory|Application
    {
        return view('transactions.create', ['request_purposes' => $this->purpose->getPurposes(), 'documents' => $this->document->getDocuments(), 'user' => Auth::user()]);
    }

    /**
     * @param Transaction $transaction
     * @return Factory|View|Application
     */
    public
    function show(Transaction $transaction)
    {
        $transaction->purpose = Purpose::find($transaction->purpose_id)->purpose_name;
        $transaction->type = Document::find($transaction->type_id)->document_name;
        $transaction->program_code = Course::find($transaction->course_id)->code;

//        dd($transaction->attributesToArray());

        return view('transactions.show', ['transaction' => $transaction]);

    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public
    function store(Request $request)
    {

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

    /**
     * @param Transaction $transaction
     * @return Factory|View|Application
     */
    public
    function edit(Transaction $transaction)
    {
//        dd($transaction->attributesToArray());

        $request_purposes = Purpose::all();
        $documents = Document::all();

        // dd($transaction);
        return view('transactions.edit', ['transaction' => $transaction, 'request_purposes' => $request_purposes, 'documents' => $documents]);
    }

    /**
     * @param Transaction $transaction
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
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
