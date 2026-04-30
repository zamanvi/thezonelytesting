<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('call_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('lead_id')->nullable()->constrained('leads')->nullOnDelete();
            $table->string('twilio_number');   // number called
            $table->string('caller_number');   // buyer's number
            $table->string('call_sid')->nullable();
            $table->enum('status', ['ringing', 'in-progress', 'completed', 'no-answer', 'busy', 'failed'])->default('ringing');
            $table->integer('duration')->default(0); // seconds
            $table->timestamp('called_at')->useCurrent();
            $table->timestamps();

            $table->index('seller_id');
            $table->index('called_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('call_logs');
    }
};
