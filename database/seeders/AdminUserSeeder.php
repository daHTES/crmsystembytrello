<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123456789'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'New User',
            'email' => 'user@test.com',
            'password' => bcrypt('user123456789'),
            'role' => 'user',
        ]);
    }
}
