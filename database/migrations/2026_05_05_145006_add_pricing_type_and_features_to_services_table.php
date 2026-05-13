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
        Schema::table('services', function (Blueprint $table) {
            if (!Schema::hasColumn('services', 'pricing_type')) {
                $table->string('pricing_type')->default('starting_at')->after('price');
            }
            if (!Schema::hasColumn('services', 'features')) {
                $table->text('features')->nullable()->after('pricing_type');
            }
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['pricing_type', 'features']);
        });
    }
};
