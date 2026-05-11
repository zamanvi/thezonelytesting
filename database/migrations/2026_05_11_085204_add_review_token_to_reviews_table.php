<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Link review to the originating lead
            $table->foreignId('lead_id')->nullable()->after('seller_id')->constrained('leads')->nullOnDelete();
            // Seller-sent review request token (public link, no login required)
            $table->string('review_token')->nullable()->unique()->after('replied_at');
            // Guest reviewer email (when reviewer_id is null)
            $table->string('reviewer_email')->nullable()->after('reviewer_name');
            // Make rating + review nullable until buyer fills the form
            $table->tinyInteger('rating')->nullable()->change();
            $table->text('review')->nullable()->change();
            // Track when token was used (review submitted)
            $table->timestamp('token_used_at')->nullable()->after('review_token');
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
