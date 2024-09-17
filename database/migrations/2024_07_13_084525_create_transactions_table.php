<?php

use App\Models\Course;
use App\Models\Document;
use App\Models\Purpose;
use App\Models\User;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class,'user_id');
            $table->string('name');
            $table->foreignIdFor(Course::class,'course_id');
            $table->integer('section');
            $table->integer('year_level');
            $table->date('date_requested');
            $table->date('date_needed');
            $table->foreignIdFor(Purpose::class,'purpose_id');
            $table->foreignIdFor(Document::class,'type_id');
            $table->string('status')->default('pending')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
