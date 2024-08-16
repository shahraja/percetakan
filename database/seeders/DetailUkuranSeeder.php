<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailUkuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $detailUkuran = [
            // Tabel Buku ukuran1 (ukuran_id = 1)
            [
                ['id' => 1,'ukuran_id' => 1, 'nama_detail_ukuran' => 'width', 'is_parent' => true],
                ['id' => 2,'ukuran_id' => 1, 'nama_detail_ukuran' => 'height', 'is_parent' => true],
                ['id' => 3, 'ukuran_id' => 1, 'nama_detail_ukuran' => 'prices', 'is_parent' => false],
            ],
            // Tabel Buku ukuran2 (ukuran_id = 2)
            [
                ['id' => 4, 'ukuran_id' => 2, 'nama_detail_ukuran' => 'width', 'is_parent' => true],
                ['id' => 5, 'ukuran_id' => 2, 'nama_detail_ukuran' => 'height', 'is_parent' => true],
                ['id' => 6, 'ukuran_id' => 2, 'nama_detail_ukuran' => 'prices', 'is_parent' => false],
            ],
            // Tabel Majalah ukuran1 (ukuran_id = 3)
            [
                ['id' => 7, 'ukuran_id' => 3, 'nama_detail_ukuran' => 'width', 'is_parent' => true],
                ['id' => 8, 'ukuran_id' => 3, 'nama_detail_ukuran' => 'height', 'is_parent' => true],
                ['id' => 9, 'ukuran_id' => 3, 'nama_detail_ukuran' => 'prices', 'is_parent' => false],
            ],
            // Tabel Majalah ukuran2 (ukuran_id = 4)
            [
                ['id' => 10, 'ukuran_id' => 4, 'nama_detail_ukuran' => 'width', 'is_parent' => true],
                ['id' => 11, 'ukuran_id' => 4, 'nama_detail_ukuran' => 'height', 'is_parent' => true],
                ['id' => 12, 'ukuran_id' => 4, 'nama_detail_ukuran' => 'prices', 'is_parent' => false],
            ],
            // Tabel Brosur ukuran1 (ukuran_id = 5)
            [
                ['id' => 14, 'ukuran_id' => 5, 'nama_detail_ukuran' => 'width', 'is_parent' => true],
                ['id' => 15, 'ukuran_id' => 5, 'nama_detail_ukuran' => 'height', 'is_parent' => true],
                ['id' => 16, 'ukuran_id' => 5, 'nama_detail_ukuran' => 'hp', 'is_parent' => true],
                ['id' => 17, 'ukuran_id' => 5, 'nama_detail_ukuran' => 'plano', 'is_parent' => false],
                ['id' => 18, 'ukuran_id' => 5, 'nama_detail_ukuran' => 'prices', 'is_parent' => false],
            ],
            // Tabel Brosur ukuran2 (ukuran_id = 6)
            [
                ['id' => 19, 'ukuran_id' => 6, 'nama_detail_ukuran' => 'width', 'is_parent' => true],
                ['id' => 20, 'ukuran_id' => 6, 'nama_detail_ukuran' => 'height', 'is_parent' => true],
                ['id' => 21, 'ukuran_id' => 6, 'nama_detail_ukuran' => 'hp', 'is_parent' => true],
                ['id' => 22, 'ukuran_id' => 6, 'nama_detail_ukuran' => 'plano', 'is_parent' => false],
                ['id' => 23, 'ukuran_id' => 6, 'nama_detail_ukuran' => 'prices', 'is_parent' => false],
            ],
            // Tabel Brosur ukuran3 (ukuran_id = 7)
            [
                ['id' => 24, 'ukuran_id' => 7, 'nama_detail_ukuran' => 'width', 'is_parent' => true],
                ['id' => 25, 'ukuran_id' => 7, 'nama_detail_ukuran' => 'height', 'is_parent' => true],
                ['id' => 26, 'ukuran_id' => 7, 'nama_detail_ukuran' => 'hp', 'is_parent' => true],
                ['id' => 27, 'ukuran_id' => 7, 'nama_detail_ukuran' => 'plano', 'is_parent' => false],
                ['id' => 28, 'ukuran_id' => 7, 'nama_detail_ukuran' => 'prices', 'is_parent' => false],
            ],
            // Tabel Brosur ukuran4 (ukuran_id = 8)
            [
                ['id' => 29, 'ukuran_id' => 8, 'nama_detail_ukuran' => 'width', 'is_parent' => true],
                ['id' => 30, 'ukuran_id' => 8, 'nama_detail_ukuran' => 'height', 'is_parent' => true],
                ['id' => 31, 'ukuran_id' => 8, 'nama_detail_ukuran' => 'hp', 'is_parent' => true],
                ['id' => 32, 'ukuran_id' => 8, 'nama_detail_ukuran' => 'plano', 'is_parent' => false],
                ['id' => 33, 'ukuran_id' => 8, 'nama_detail_ukuran' => 'prices', 'is_parent' => false],
            ],
            // Tabel Brosur ukuran5 (ukuran_id = 9)
            [
                ['id' => 34, 'ukuran_id' => 9, 'nama_detail_ukuran' => 'width', 'is_parent' => true],
                ['id' => 35, 'ukuran_id' => 9, 'nama_detail_ukuran' => 'height', 'is_parent' => true],
                ['id' => 36, 'ukuran_id' => 9, 'nama_detail_ukuran' => 'hp', 'is_parent' => true],
                ['id' => 37, 'ukuran_id' => 9, 'nama_detail_ukuran' => 'plano', 'is_parent' => false],
                ['id' => 38, 'ukuran_id' => 9, 'nama_detail_ukuran' => 'prices', 'is_parent' => false],
            ],
            // Tabel Brosur ukuran6 (ukuran_id = 10)
            [
                ['id' => 39, 'ukuran_id' => 10, 'nama_detail_ukuran' => 'width', 'is_parent' => true],
                ['id' => 40, 'ukuran_id' => 10, 'nama_detail_ukuran' => 'height', 'is_parent' => true],
                ['id' => 41, 'ukuran_id' => 10, 'nama_detail_ukuran' => 'hp', 'is_parent' => true],
                ['id' => 42, 'ukuran_id' => 10, 'nama_detail_ukuran' => 'plano', 'is_parent' => false],
                ['id' => 43, 'ukuran_id' => 10, 'nama_detail_ukuran' => 'prices', 'is_parent' => false],
            ],
            // Tabel Undangan ukuran1 (ukuran_id = 11)
            [
                ['id' => 44, 'ukuran_id' => 11, 'nama_detail_ukuran' => 'width', 'is_parent' => true],
                ['id' => 45, 'ukuran_id' => 11, 'nama_detail_ukuran' => 'height', 'is_parent' => true],
                ['id' => 46, 'ukuran_id' => 11, 'nama_detail_ukuran' => 'hp', 'is_parent' => true],
                ['id' => 47, 'ukuran_id' => 11, 'nama_detail_ukuran' => 'plano', 'is_parent' => false],
                ['id' => 48, 'ukuran_id' => 11, 'nama_detail_ukuran' => 'prices', 'is_parent' => false],
            ],
            // Tabel Undangan ukuran2 (ukuran_id = 12)
            [
                ['id' => 49, 'ukuran_id' => 12, 'nama_detail_ukuran' => 'width', 'is_parent' => true],
                ['id' => 50, 'ukuran_id' => 12, 'nama_detail_ukuran' => 'height', 'is_parent' => true],
                ['id' => 51, 'ukuran_id' => 12, 'nama_detail_ukuran' => 'hp', 'is_parent' => true],
                ['id' => 52, 'ukuran_id' => 12, 'nama_detail_ukuran' => 'plano', 'is_parent' => false],
                ['id' => 53, 'ukuran_id' => 12, 'nama_detail_ukuran' => 'prices', 'is_parent' => false],
            ],
            // Tabel Undangan ukuran3 (ukuran_id = 13)
            [
                ['id' => 54, 'ukuran_id' => 13, 'nama_detail_ukuran' => 'width', 'is_parent' => true],
                ['id' => 55, 'ukuran_id' => 13, 'nama_detail_ukuran' => 'height', 'is_parent' => true],
                ['id' => 56, 'ukuran_id' => 13, 'nama_detail_ukuran' => 'hp', 'is_parent' => true],
                ['id' => 57, 'ukuran_id' => 13, 'nama_detail_ukuran' => 'plano', 'is_parent' => false],
                ['id' => 58, 'ukuran_id' => 13, 'nama_detail_ukuran' => 'prices', 'is_parent' => false],
            ],
            // Tabel Undangan ukuran4 (ukuran_id = 14)
            [
                ['id' => 59, 'ukuran_id' => 14, 'nama_detail_ukuran' => 'width', 'is_parent' => true],
                ['id' => 60, 'ukuran_id' => 14, 'nama_detail_ukuran' => 'height', 'is_parent' => true],
                ['id' => 61, 'ukuran_id' => 14, 'nama_detail_ukuran' => 'hp', 'is_parent' => true],
                ['id' => 62, 'ukuran_id' => 14, 'nama_detail_ukuran' => 'plano', 'is_parent' => false],
                ['id' => 63, 'ukuran_id' => 14, 'nama_detail_ukuran' => 'prices', 'is_parent' => false],
            ],
            // Tabel Undangan ukuran5 (ukuran_id = 15)
            [
                ['id' => 64, 'ukuran_id' => 15, 'nama_detail_ukuran' => 'width', 'is_parent' => true],
                ['id' => 65, 'ukuran_id' => 15, 'nama_detail_ukuran' => 'height', 'is_parent' => true],
                ['id' => 66, 'ukuran_id' => 15, 'nama_detail_ukuran' => 'hp', 'is_parent' => true],
                ['id' => 67, 'ukuran_id' => 15, 'nama_detail_ukuran' => 'plano', 'is_parent' => false],
                ['id' => 68, 'ukuran_id' => 15, 'nama_detail_ukuran' => 'prices', 'is_parent' => false],
            ],
            // Tabel Undangan ukuran6 (ukuran_id = 16)
            [
                ['id' => 69, 'ukuran_id' => 16, 'nama_detail_ukuran' => 'width', 'is_parent' => true],
                ['id' => 70, 'ukuran_id' => 16, 'nama_detail_ukuran' => 'height', 'is_parent' => true],
                ['id' => 71, 'ukuran_id' => 16, 'nama_detail_ukuran' => 'hp', 'is_parent' => true],
                ['id' => 72, 'ukuran_id' => 16, 'nama_detail_ukuran' => 'plano', 'is_parent' => false],
                ['id' => 73, 'ukuran_id' => 16, 'nama_detail_ukuran' => 'prices', 'is_parent' => false],
            ],
            // Tabel Kalender ukuran1 (ukuran_id = 17)
            [
                ['id' => 74, 'ukuran_id' => 17, 'nama_detail_ukuran' => 'width', 'is_parent' => true],
                ['id' => 75, 'ukuran_id' => 17, 'nama_detail_ukuran' => 'height', 'is_parent' => true],
                ['id' => 76, 'ukuran_id' => 17, 'nama_detail_ukuran' => 'hp', 'is_parent' => true],
                ['id' => 77, 'ukuran_id' => 17, 'nama_detail_ukuran' => 'plano', 'is_parent' => false],
                ['id' => 78, 'ukuran_id' => 17, 'nama_detail_ukuran' => 'prices', 'is_parent' => false],
            ],
            // Tabel Kalender ukuran2 (ukuran_id = 18)
            [
                ['id' => 79, 'ukuran_id' => 18, 'nama_detail_ukuran' => 'width', 'is_parent' => true],
                ['id' => 80, 'ukuran_id' => 18, 'nama_detail_ukuran' => 'height', 'is_parent' => true],
                ['id' => 81, 'ukuran_id' => 18, 'nama_detail_ukuran' => 'hp', 'is_parent' => true],
                ['id' => 82, 'ukuran_id' => 18, 'nama_detail_ukuran' => 'plano', 'is_parent' => false],
                ['id' => 83, 'ukuran_id' => 18, 'nama_detail_ukuran' => 'prices', 'is_parent' => false],
            ],
        ];
        
        foreach ($detailUkuran as $ukuran) {
            foreach ($ukuran as $detail) {
                DB::table('detail_ukuran')->insert($detail);
            }
        }        
    }
}
