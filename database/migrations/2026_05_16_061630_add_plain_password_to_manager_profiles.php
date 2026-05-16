<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('manager_profiles', function (Blueprint $table) {
            $table->string('plain_password')->nullable()->after('notes');
            $table->string('login_url')->nullable()->after('plain_password');
        });
    }

    public function down(): void
    {
        Schema::table('manager_profiles', function (Blueprint $table) {
            $table->dropColumn(['plain_password', 'login_url']);
        });
    }
};
