<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_document', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Transaction::class, 'transaction_id');
            $table->foreignIdFor(\App\Models\Document::class, 'document_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_document');
    }
};
