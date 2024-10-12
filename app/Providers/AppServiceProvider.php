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
        Gate::define('show-transaction', function (User $user) {
            return $user->isTreasurer() || $user->isAdmin() || $user->isNormalUser();
        });

        Gate::define("edit-transaction", function (User $user,Transaction $transaction) {
            return ( $transaction->user()->is($user));
        });

        Gate::define("create-transaction", function (User $user) {
            return ( $user->isNormalUser() );
        });

    }
}
