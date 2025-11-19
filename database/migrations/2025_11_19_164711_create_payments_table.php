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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_date');
            $table->string('amount');
            $table->enum('method', ['cash', 'bank', 'card', 'mobile', 'online']);
            $table->string('reference_number');
            $table->enum('status', ['completed', 'pending', 'failed', 'refunded']);
            $table->foreignId('policy_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
