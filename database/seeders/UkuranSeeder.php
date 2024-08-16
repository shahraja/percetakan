<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UkuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ukuran = [
            // Tabel Buku (product_id = 1)
            [
                ['id' => 1, 'product_id' => 1, 'nama_ukuran' => 'A4'],
                ['id' => 2, 'product_id' => 1, 'nama_ukuran' => 'A5'],
            ],
            // Tabel Majalah (product_id = 5)
            [
                ['id' => 3, 'product_id' => 5, 'nama_ukuran' => 'A4'],
                ['id' => 4, 'product_id' => 5, 'nama_ukuran' => 'A5'],
            ],
            // Tabel Brosur (product_id = 2)
            [
                ['id' => 5, 'product_id' => 2, 'nama_ukuran' => 'plano1'],
                ['id' => 6, 'product_id' => 2, 'nama_ukuran' => 'plano2'],
                ['id' => 7, 'product_id' => 2, 'nama_ukuran' => 'plano3'],
                ['id' => 8, 'product_id' => 2, 'nama_ukuran' => 'plano4'],
                ['id' => 9, 'product_id' => 2, 'nama_ukuran' => 'plano5'],
                ['id' => 10, 'product_id' => 2, 'nama_ukuran' => 'plano6'],
            ],
            // Tabel Undangan (product_id = 4)
            [
                ['id' => 11, 'product_id' => 4, 'nama_ukuran' => 'plano1'],
                ['id' => 12, 'product_id' => 4, 'nama_ukuran' => 'plano2'],
                ['id' => 13, 'product_id' => 4, 'nama_ukuran' => 'plano3'],
                ['id' => 14, 'product_id' => 4, 'nama_ukuran' => 'plano4'],
                ['id' => 15, 'product_id' => 4, 'nama_ukuran' => 'plano5'],
                ['id' => 16, 'product_id' => 4, 'nama_ukuran' => 'plano6'],
            ],
            // Tabel Kalender (product_id = 3)
            [
                ['id' => 17, 'product_id' => 3, 'nama_ukuran' => 'plano4'],
                ['id' => 18, 'product_id' => 3, 'nama_ukuran' => 'plano7'],
            ],
        ];
        
        // Merge all size arrays into one array
        $ukuran = array_merge(...$ukuran);
        
        DB::table('ukuran')->insert($ukuran);
        
    }
}
