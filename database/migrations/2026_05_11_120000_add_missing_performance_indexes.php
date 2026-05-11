<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->index('referred_by');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->index('seller_id');
            $table->index('review_token');
            $table->index(['seller_id', 'rating']);
            $table->index(['seller_id', 'created_at']);
        });

        Schema::table('leads', function (Blueprint $table) {
            $table->index('created_at');
        });

        Schema::table('affiliate_commissions', function (Blueprint $table) {
            $table->index('referrer_id');
            $table->index(['referrer_id', 'status']);
        });

        Schema::table('staff_profiles', function (Blueprint $table) {
            $table->index('parent_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['referred_by']);
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropIndex(['seller_id']);
            $table->dropIndex(['review_token']);
            $table->dropIndex(['seller_id', 'rating']);
            $table->dropIndex(['seller_id', 'created_at']);
        });

        Schema::table('leads', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
        });

        Schema::table('affiliate_commissions', function (Blueprint $table) {
            $table->dropIndex(['referrer_id']);
            $table->dropIndex(['referrer_id', 'status']);
        });

        Schema::table('staff_profiles', function (Blueprint $table) {
            $table->dropIndex(['parent_id']);
        });
    }
};
