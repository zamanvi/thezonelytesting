<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('twilio_numbers', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();          // +13475550001
            $table->string('friendly_name')->nullable(); // (347) 555-0001
            $table->foreignId('seller_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('assigned_at')->nullable();
            $table->enum('status', ['available', 'assigned', 'released'])->default('available');
            $table->string('twilio_sid')->nullable();    // PN... sid from Twilio
            $table->timestamps();

            $table->index('status');
            $table->index('seller_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('twilio_numbers');
    }
};
