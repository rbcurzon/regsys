 <?php

use App\Models\Course;
use App\Models\Document;
use App\Models\Purpose;
use App\Models\User;
 use Carbon\Carbon;
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
            $table->foreignIdFor(User::class,'student_id');
            $table->date('requested_date')->default(Carbon::now()->setTimezone('UTC'));
            $table->date('needed_date');
            $table->foreignIdFor(Purpose::class,'purpose_id');
            $table->foreignIdFor(Document::class,'document_id');
            $table->boolean('is_paid')->default(false);
            $table->string('status')->default('pending')->nullable(false);
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
