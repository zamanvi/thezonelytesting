<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            if (!Schema::hasColumn('reviews', 'lead_id')) {
                $table->foreignId('lead_id')->nullable()->after('seller_id')->constrained('leads')->nullOnDelete();
            }
            if (!Schema::hasColumn('reviews', 'review_token')) {
                $table->string('review_token')->nullable()->unique()->after('replied_at');
            }
            if (!Schema::hasColumn('reviews', 'reviewer_email')) {
                $table->string('reviewer_email')->nullable()->after('reviewer_name');
            }
            if (!Schema::hasColumn('reviews', 'token_used_at')) {
                $table->timestamp('token_used_at')->nullable()->after('review_token');
            }
            $table->tinyInteger('rating')->nullable()->change();
            $table->text('review')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['lead_id']);
            $table->dropColumn(['lead_id', 'review_token', 'reviewer_email', 'token_used_at']);
            $table->tinyInteger('rating')->nullable(false)->change();
            $table->text('review')->nullable(false)->change();
        });
    }
};
