<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('show_phone')->default(true)->after('whatsapp');
        });

        // Change category_id from string to unsignedBigInteger
        // Drop string column and re-add as proper FK type
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('category_id');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('experience');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('show_phone');
            $table->dropColumn('category_id');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('category_id')->nullable()->after('experience');
        });
    }
};
