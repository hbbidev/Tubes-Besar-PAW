<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Buat Akun Admin
        User::create([
            'name' => 'Admin Ganteng',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        // Buat Akun Member
        User::create([
            'name' => 'Member Setia',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user'),
            'role' => 'member',
        ]);
    }
}
