<?php

use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SessionController;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return view('test');
});

Route::get('/search', SearchController::class);

//Route::resource("transactions", TransactionController::class);
Route::get('/', [TransactionController::class, 'index'])->middleware('auth');
Route::get('/transactions/create', [TransactionController::class, 'create'])->middleware('auth');
Route::post('/transactions', [TransactionController::class, 'store']);
Route::get('/transactions/{transaction}/show', [TransactionController::class, 'show'])
    ->middleware('auth')
    ->can("edit-transaction", "transaction");
Route::get('/transactions/{transaction}/edit', [TransactionController::class, 'edit'])
    ->middleware('auth')
    ->can("edit-transaction", "transaction");
Route::patch('/transactions/{transaction}', [TransactionController::class, 'update'])
    ->middleware('auth')
    ->can("edit-transaction", "transaction");
Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])
    ->middleware('auth')
    ->can("edit-transactions", "transaction");

//Auth
Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

