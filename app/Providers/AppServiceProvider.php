<?php

namespace App\Providers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        Gate::define('edit-payments', function (User $user) {
            return $user->is_treasurer;
        });

        Gate::define("edit-transaction", function (User $user,Transaction $transaction) {
            return $transaction->user()->is($user);
        });

        Gate::define("edit-transactions", function (User $user) {
            return ($user->is_admin);
        });

    }
}
