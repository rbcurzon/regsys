<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke()
    {
        $transactions = Transaction::where("id", "LIKE", "%".request('q')."%")
        ->orWhere("user_id", "LIKE", "%".request('q')."%")
        ->orWhere("status", "LIKE", "%".request('q')."%")
        ->paginate(5);

        return view('results', ['transactions' => $transactions, 'q' => request('q')]);

    }

//    TODO: Search function for admin
//    TODO: Search function for admin
//    TODO: Search function for student
}
