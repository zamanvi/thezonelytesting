<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'norozzaman995@gmail.com'],
            [
                'name'     => 'Admin',
                'slug'     => 'admin',
                'email'    => 'norozzaman995@gmail.com',
                'password' => '$2y$10$U.eM10vaUKOOG9IuENOqq.ybCYb4RMRbnywcn1XfkdEyQeKFELMaO',
                'type'     => 'admin',
                'status'   => 1,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
