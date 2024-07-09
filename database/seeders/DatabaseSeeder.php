<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ProductSeeder::class);
        // $this->call(CartSeeder::class);
        $this->call(UserSeeder::class);
        // $this->call(TransaksiSeeder::class);
        $this->call(BrosurSeeder::class);
        $this->call(BukuSeeder::class);
        $this->call(KalenderSeeder::class);
        $this->call(MajalahSeeder::class);
        $this->call(UndanganSeeder::class);
        $this->call(PaymentSeeder::class);
    }
}
