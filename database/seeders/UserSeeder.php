<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin
        User::create([
            'username' => 'admin',
            'email'    => 'admin@school.com',
            'password' => Hash::make('password123'),
            'role'     => 'admin',
        ]);

        // 2. Akun Teacher
        User::create([
            'username' => 'teacher',
            'email'    => 'teacher@school.com',
            'password' => Hash::make('password123'),
            'role'     => 'teacher',
        ]);

        // 3. Akun Student
        User::create([
            'username' => 'student',
            'email'    => 'student@school.com',
            'password' => Hash::make('password123'),
            'role'     => 'student',
        ]);
    }
}
