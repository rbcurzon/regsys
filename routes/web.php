<?php

use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::resource("transactions", TransactionController::class);
Route::get('/transactions', [TransactionController::class, 'index']);
Route::get('/transactions/create', [TransactionController::class, 'create'])->middleware('auth');
Route::post('/transactions', [TransactionController::class, 'store']);
Route::get('/transactions/{transaction}/show', [TransactionController::class, 'show'])
    ->middleware('auth')
    ->can("edit-transaction", "transaction");;
Route::get('/transactions/{transaction}/edit', [TransactionController::class, 'edit'])
    ->middleware('auth')
    ->can("edit-transaction", "transaction");
Route::patch('/transactions/{transaction}', [TransactionController::class, 'update'])
    ->middleware('auth')
    ->can("edit-transaction", "transaction");;
Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])
    ->middleware('auth')
    ->can("edit-transaction", "transaction");

//Auth
Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

