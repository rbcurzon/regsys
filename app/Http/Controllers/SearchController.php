<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function __invoke()
    {
        $transactions = Transaction::where("id", "LIKE", "%".request('q')."%")
        ->orWhere("user_id", "LIKE", "%".request('q')."%")
        ->orWhere("status", "LIKE", "%".request('q')."%")
        ->paginate(5);

        return view('results', ['transactions' => $transactions, 'q' => request('q'), 'user'=>Auth::user()]);

    }

//    TODO: Search function for admin
//    TODO: Search function for admin
//    TODO: Search function for student
}
