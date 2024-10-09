<?php

use App\Models\Transaction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id('account_id');
            $table->string('name');
        });

        Schema::create('journals', function (Blueprint $table) {
            $table->id('journal_id');
            $table->foreignId('financial_transaction_id');
            $table->foreignId("account_id");
            $table->float("amount");
            $table->boolean('is_credit')->nullable(false);
        });

        Schema::create('financial_transactions', function (Blueprint $table) {
            $table->id('financial_transaction_id');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
        Schema::dropIfExists('financial_transactions');
        Schema::dropIfExists('journals');
    }
};
