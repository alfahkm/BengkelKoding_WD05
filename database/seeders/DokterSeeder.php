<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DokterSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'nama' => 'Dokter Contoh',
            'email' => 'dokter@example.com',
            'password' => Hash::make('password123'), // password default
            'role' => 'dokter',
            'alamat' => 'Alamat Dokter',
            'no_hp' => '081234567891',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
