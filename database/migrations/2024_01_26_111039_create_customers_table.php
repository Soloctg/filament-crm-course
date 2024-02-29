<?php


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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::table('customers', function (Blueprint $table) {
            $table->foreignIdFor(User::class, 'employee_id')->nullable()->constrained('users');
        });


        Schema::table('customer_pipeline_stages', function (Blueprint $table) {
            $table->foreignIdFor(User::class, 'employee_id')->nullable()->constrained('users');
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
