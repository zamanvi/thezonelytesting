<?php

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
        Schema::create('policies', function (Blueprint $table) {
            $table->id();
            $table->string('policy_number')->unique();
            $table->string('insurance_company');
            $table->enum('policy_type', ['Liability', 'Comprehensive', 'Full Coverage']);
            $table->string('start_date');
            $table->string('end_date');
            $table->string('premium_amount');
            $table->string('coverage_amount');
            $table->string('deductible')->nullable();
            $table->enum('status', ['Active', 'Expired', 'Cancelled']);
            $table->text('notes')->nullable();
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policies');
    }
};
