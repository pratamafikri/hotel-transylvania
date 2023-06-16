<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('users')->insert([
            'no_ktp' => '3201234567890987',
            'email' => 'admin-transyl@gmail.com',
            'fullname' => 'Admin Transylvania',
            'phone_number' => '081234567890',
            'address' => 'Jalan yang jauh jangan lupa pulang',
            'nationality' => 'Indonesia',
            'username' => 'admin',
            'password' => bcrypt('password'),
            'status' => 'aktif',
            'role' => 'admin'
        ]);
    }
}
