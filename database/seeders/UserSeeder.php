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
                'name' => 'Test User',
                'email' => 'admin@admin.com',
                'role' => 'admin',
                'password' => Hash::make('password')
                ],
                [
                'name' => 'Test User',
                'email' => 'user@user.com',
                'role' => 'user',
                'password' => Hash::make('password')
                ],
        ];
        User::query()->insert($User);
    }
}
