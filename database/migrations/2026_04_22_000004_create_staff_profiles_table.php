<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('role', ['area_manager','city_manager','district_manager','country_manager']);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('staff_profiles')->onDelete('set null');
            $table->string('assigned_area')->nullable();   // ZIP / city / district / state name
            $table->string('assigned_state')->nullable();
            $table->decimal('base_salary', 10, 2)->default(0);
            $table->decimal('commission_rate', 5, 2)->default(0); // percent
            $table->enum('status', ['active','inactive','probation'])->default('active');
            $table->date('joined_at')->nullable();
            $table->text('notes')->nullable();
            // KPI snapshot fields (updated periodically)
            $table->integer('sellers_onboarded')->default(0);
            $table->integer('active_sellers')->default(0);
            $table->decimal('dispute_rate', 5, 2)->default(0); // percent
            $table->decimal('revenue_generated', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff_profiles');
    }
};
