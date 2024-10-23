<?php

use App\Http\Controllers\JournalController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SessionController;
use App\Models\Course;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return view('receipt');
});

Route::get('/search', SearchController::class)->middleware('auth');

Route::get('/', [TransactionController::class, 'index'])
    ->middleware('auth');
Route::get('/transactions/create', [TransactionController::class, 'create'])
    ->middleware('auth')
    ->can('create', Transaction::class);
Route::post('/transactions', [TransactionController::class, 'store'])
    ->middleware('auth')
    ->can('create', Transaction::class);
Route::get('/transactions/{transaction}/show', [TransactionController::class, 'show'])
    ->middleware('auth')
    ->can("view", "transaction");
Route::get('/transactions/{transaction}/edit', [TransactionController::class, 'edit'])
    ->middleware('auth')
    ->can("update", ["transaction"]);
Route::patch('/transactions/{transaction}', [TransactionController::class, 'update'])
    ->middleware('auth')
    ->can("update", ['transaction']);
Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])
    ->middleware('auth')
    ->can("delete", ['transaction']);

Route::post('/journals', [JournalController::class, 'store']);

//Auth
Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

