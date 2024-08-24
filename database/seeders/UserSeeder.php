<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $User = [
            [
                'gambar' => 'undangan.jpg',
                'name' => 'Test User',
                'email' => 'admin@admin.com',
                'role' => 'admin',
                'no_telp' => '08558464',
                'alamat' => 'jalan raya',
                'provinsi' => 'lampung',
                'kota' => 'bandar lampung',
                'kecamatan' => 'campang jaya',
                'email_verified_at' => now(),
                'password' => Hash::make('password')
                ],
                [
                'gambar' => 'undangan.jpg',
                'name' => 'Test User',
                'email' => 'user@user.com',
                'role' => 'user',
                'no_telp' => '08558464878',
                'alamat' => 'jalan raya',
                'provinsi' => 'lampung',
                'kota' => 'bandar lampung',
                'kecamatan' => 'campang jaya',
                'email_verified_at' => now(),
                'password' => Hash::make('password')
                ],
        ];
        User::query()->insert($User);
    }
}
