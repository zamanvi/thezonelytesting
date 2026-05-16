<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN type ENUM('admin','coo','manager','staff','seller','user','staf') NOT NULL DEFAULT 'user'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN type ENUM('admin','manager','staff','seller','user','staf') NOT NULL DEFAULT 'user'");
    }
};
