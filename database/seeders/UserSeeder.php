<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
    'nama_lengkap' => 'pengguna',
    'username' => 'user',
    'password' => Hash::make('user123'), // Harus pakai Hash::make
    'role' => 'user',
]);
    }
}