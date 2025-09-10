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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type')->default('user');
            $table->string('email')->unique();
            $table->string('title')->nullable();
            $table->string('phone')->nullable();
            $table->string('designation')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('work_address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('status')->default(true);
            $table->string('password');
            $table->longText('about')->nullable();
            $table->string('remark')->nullable();
            $table->string('slug')->unique();
            $table->string('profile_photo')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
