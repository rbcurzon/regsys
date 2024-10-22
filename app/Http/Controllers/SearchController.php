<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function __invoke()
    {
        if (Auth::user()->isNormalUser()) {
            $transactions = Auth::user()->transactions()->where(function (Builder $query) {
                return $query->where('status', 'LIKE', request('q') . '%')
                    ->orWhere("user_id", "LIKE", "%" . request('q') . "%")
                    ->orWhere("status", "LIKE", "%" . request('q') . "%");
            })
                ->orderBy("needed_date")
                ->get();
        } else {
            if (request('q') === 'on process') {
                $transactions = Transaction::where("id", "LIKE", "%" . request('q') . "%")
                    ->orWhere("status", "LIKE", "%processing%")
                    ->orWhere("status", "LIKE", "%releasing%")
                    ->orderBy("needed_date")
                    ->get();
            } else {
                $transactions = Transaction::where("id", "LIKE", "%" . request('q') . "%")
                    ->orWhere("user_id", "LIKE", "%" . request('q') . "%")
                    ->orWhere("status", "LIKE", "%" . request('q') . "%")
                    ->orderBy("needed_date")
                    ->get();
            }
        }
//        dd($transactions->count());

        return view('results', ['transactions' => $transactions, 'q' => request('q'), 'user' => Auth::user()]);
    }

//    TODO: Search function for admin
//    TODO: Search function for admin
//    TODO: Search function for student
}
