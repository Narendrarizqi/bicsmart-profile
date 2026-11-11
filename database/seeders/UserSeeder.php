<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun awal Super Admin. WAJIB ganti password setelah login pertama.
        User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@bicsmart.test')],
            [
                'name' => 'Admin BiC-SMART',
                'password' => env('ADMIN_PASSWORD') ?: throw new \RuntimeException('ADMIN_PASSWORD belum diatur di file .env'),
                'role' => User::ROLE_SUPER_ADMIN,
                'is_active' => true,
            ],
        );
    }
}
