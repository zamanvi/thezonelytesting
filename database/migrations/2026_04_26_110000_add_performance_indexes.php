<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->index('type');
            $table->index('status');
            $table->index('category_id');
            $table->index('slug');
            $table->index(['type', 'status']);
        });

        Schema::table('leads', function (Blueprint $table) {
            $table->index('seller_id');
            $table->index('status');
            $table->index('paid_at');
            $table->index(['seller_id', 'status']);
            $table->index(['seller_id', 'paid_at']);
        });

        Schema::table('staff_profiles', function (Blueprint $table) {
            $table->index('role');
            $table->index('status');
        });

        Schema::table('manager_profiles', function (Blueprint $table) {
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['type']);
            $table->dropIndex(['status']);
            $table->dropIndex(['category_id']);
            $table->dropIndex(['slug']);
            $table->dropIndex(['type', 'status']);
        });

        Schema::table('leads', function (Blueprint $table) {
            $table->dropIndex(['seller_id']);
            $table->dropIndex(['status']);
            $table->dropIndex(['paid_at']);
            $table->dropIndex(['seller_id', 'status']);
            $table->dropIndex(['seller_id', 'paid_at']);
        });

        Schema::table('staff_profiles', function (Blueprint $table) {
            $table->dropIndex(['role']);
            $table->dropIndex(['status']);
        });

        Schema::table('manager_profiles', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });
    }
};
