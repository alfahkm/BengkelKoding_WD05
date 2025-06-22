<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'prass',
                'no_hp' => '0987654321',
                'alamat' => 'semarang',
                'role' => 'pasien',
                'email' => 'prass@gmail.com',
                'password' => '123',
            ],
            [
                'nama' => 'alfa',
                'no_hp' => '0987654323',
                'alamat' => 'semarang',
                'role' => 'dokter',
                'email' => 'alfa@gmail.com',
                'password' => '123',
            ],
            [
                'nama' => 'deni',
                'no_hp' => '0987654324',
                'alamat' => 'semarang',
                'role' => 'pasien',
                'email' => 'deni@gmail.com',
                'password' => '123',
            ],
            [
                'nama' => 'bogor',
                'no_hp' => '0987654325',
                'alamat' => 'semarang',
                'role' => 'dokter',
                'email' => 'bogor@gmail.com',
                'password' => '123',
            ],
            [
                'nama' => 'admin',
                'no_hp' => '081234567899',
                'alamat' => 'alamat admin',
                'role' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => '123',
            ],
        ];
        
        foreach ($data as $d) {
            User::create([
                'nama' => $d['nama'],
                'email' => $d['email'],
                'password' => bcrypt($d['password']),
                'alamat' => $d['alamat'],
                'no_hp' => $d['no_hp'],
                'role' => $d['role'],
            ]);
        }
    }
}
