<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailValueUkuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $detailValueUkuran = [
            // Tabel Buku ukuran1
            [
                'detail_ukuran_id' => 1,
                'nama_value_ukuran' => 'width',
                'value' => 21,
            ],
            [
                'detail_ukuran_id' => 2,
                'nama_value_ukuran' => 'height',
                'value' => 28,
            ],
            [
                'detail_ukuran_id' => 3,
                'nama_value_ukuran' => '120',
                'value' => 2000,
            ],
            [
                'detail_ukuran_id' => 3,
                'nama_value_ukuran' => '150',
                'value' => 2300,
            ],

            // Tabel Buku ukuran2
            [
                'detail_ukuran_id' => 4,
                'nama_value_ukuran' => 'width',
                'value' => 14.8,
            ],
            [
                'detail_ukuran_id' => 5,
                'nama_value_ukuran' => 'height',
                'value' => 21,
            ],
            [
                'detail_ukuran_id' => 6,
                'nama_value_ukuran' => '120',
                'value' => 2100,
            ],
            [
                'detail_ukuran_id' => 6,
                'nama_value_ukuran' => '150',
                'value' => 2450,
            ],

            // Tabel Majalah ukuran1
            [
                'detail_ukuran_id' => 7,
                'nama_value_ukuran' => 'width',
                'value' => 21,
            ],
            [
                'detail_ukuran_id' => 8,
                'nama_value_ukuran' => 'height',
                'value' => 28,
            ],
            [
                'detail_ukuran_id' => 9,
                'nama_value_ukuran' => '120',
                'value' => 2000,
            ],
            [
                'detail_ukuran_id' => 9,
                'nama_value_ukuran' => '150',
                'value' => 2300,
            ],

            // Tabel Majalah ukuran2
            [
                'detail_ukuran_id' => 10,
                'nama_value_ukuran' => 'width',
                'value' => 14.8,
            ],
            [
                'detail_ukuran_id' => 11,
                'nama_value_ukuran' => 'height',
                'value' => 21,
            ],
            [
                'detail_ukuran_id' => 12,
                'nama_value_ukuran' => '120',
                'value' => 2100,
            ],
            [
                'detail_ukuran_id' => 12,
                'nama_value_ukuran' => '150',
                'value' => 2450,
            ],

            // Tabel Brosur ukuran1
            [
                'detail_ukuran_id' => 14,
                'nama_value_ukuran' => 'width',
                'value' => 30.5,
            ],
            [
                'detail_ukuran_id' => 15,
                'nama_value_ukuran' => 'height',
                'value' => 46,
            ],
            [
                'detail_ukuran_id' => 16,
                'nama_value_ukuran' => 'hp',
                'value' => 3200,
            ],
            [
                'detail_ukuran_id' => 17,
                'nama_value_ukuran' => 'plano',
                'value' => 61,
            ],
            [
                'detail_ukuran_id' => 17,
                'nama_value_ukuran' => 'plano',
                'value' => 92,
            ],
            [
                'detail_ukuran_id' => 18,
                'nama_value_ukuran' => '120',
                'value' => 2000,
            ],
            [
                'detail_ukuran_id' => 18,
                'nama_value_ukuran' => '150',
                'value' => 2300,
            ],
            [
                'detail_ukuran_id' => 18,
                'nama_value_ukuran' => '190',
                'value' => 2950,
            ],
            [
                'detail_ukuran_id' => 18,
                'nama_value_ukuran' => '210',
                'value' => 3200,
            ],
            [
                'detail_ukuran_id' => 18,
                'nama_value_ukuran' => '230',
                'value' => 3500,
            ],

            // Tabel Brosur ukuran2
            [
                'detail_ukuran_id' => 19,
                'nama_value_ukuran' => 'width',
                'value' => 32.5,
            ],
            [
                'detail_ukuran_id' => 20,
                'nama_value_ukuran' => 'height',
                'value' => 45,
            ],
            [
                'detail_ukuran_id' => 21,
                'nama_value_ukuran' => 'hp',
                'value' => 3400,
            ],
            [
                'detail_ukuran_id' => 22,
                'nama_value_ukuran' => 'plano',
                'value' => 65,
            ],
            [
                'detail_ukuran_id' => 22,
                'nama_value_ukuran' => 'plano',
                'value' => 90,
            ],
            [
                'detail_ukuran_id' => 23,
                'nama_value_ukuran' => '120',
                'value' => 2100,
            ],
            [
                'detail_ukuran_id' => 23,
                'nama_value_ukuran' => '150',
                'value' => 2450,
            ],
            [
                'detail_ukuran_id' => 23,
                'nama_value_ukuran' => '190',
                'value' => 3050,
            ],
            [
                'detail_ukuran_id' => 23,
                'nama_value_ukuran' => '210',
                'value' => 3400,
            ],
            [
                'detail_ukuran_id' => 23,
                'nama_value_ukuran' => '230',
                'value' => 3600,
            ],
            [
                'detail_ukuran_id' => 23,
                'nama_value_ukuran' => '260',
                'value' => 4050,
            ],
            [
                'detail_ukuran_id' => 23,
                'nama_value_ukuran' => '310',
                'value' => 4800,
            ],

            // Tabel Brosur ukuran3
            [
                'detail_ukuran_id' => 24,
                'nama_value_ukuran' => 'width',
                'value' => 32.5,
            ],
            [
                'detail_ukuran_id' => 25,
                'nama_value_ukuran' => 'height',
                'value' => 50,
            ],
            [
                'detail_ukuran_id' => 26,
                'nama_value_ukuran' => 'hp',
                'value' => 3700,
            ],
            [
                'detail_ukuran_id' => 27,
                'nama_value_ukuran' => 'plano',
                'value' => 65,
            ],
            [
                'detail_ukuran_id' => 27,
                'nama_value_ukuran' => 'plano',
                'value' => 100,
            ],
            [
                'detail_ukuran_id' => 28,
                'nama_value_ukuran' => '120',
                'value' => 2250,
            ],
            [
                'detail_ukuran_id' => 28,
                'nama_value_ukuran' => '150',
                'value' => 2700,
            ],
            [
                'detail_ukuran_id' => 28,
                'nama_value_ukuran' => '190',
                'value' => 3400,
            ],
            [
                'detail_ukuran_id' => 28,
                'nama_value_ukuran' => '210',
                'value' => 3700,
            ],
            [
                'detail_ukuran_id' => 28,
                'nama_value_ukuran' => '230',
                'value' => 4000,
            ],
            [
                'detail_ukuran_id' => 28,
                'nama_value_ukuran' => '260',
                'value' => 4500,
            ],
            [
                'detail_ukuran_id' => 28,
                'nama_value_ukuran' => '310',
                'value' => 5200,
            ],

            // Tabel Brosur ukuran4
            [
                'detail_ukuran_id' => 29,
                'nama_value_ukuran' => 'width',
                'value' => 39.5,
            ],
            [
                'detail_ukuran_id' => 30,
                'nama_value_ukuran' => 'height',
                'value' => 54.5,
            ],
            [
                'detail_ukuran_id' => 31,
                'nama_value_ukuran' => 'hp',
                'value' => 4800,
            ],
            [
                'detail_ukuran_id' => 32,
                'nama_value_ukuran' => 'plano',
                'value' => 79,
            ],
            [
                'detail_ukuran_id' => 32,
                'nama_value_ukuran' => 'plano',
                'value' => 109,
            ],
            [
                'detail_ukuran_id' => 33,
                'nama_value_ukuran' => '120',
                'value' => 2900,
            ],
            [
                'detail_ukuran_id' => 33,
                'nama_value_ukuran' => '150',
                'value' => 3500,
            ],
            [
                'detail_ukuran_id' => 33,
                'nama_value_ukuran' => '190',
                'value' => 4400,
            ],
            [
                'detail_ukuran_id' => 33,
                'nama_value_ukuran' => '210',
                'value' => 4800,
            ],
            [
                'detail_ukuran_id' => 33,
                'nama_value_ukuran' => '230',
                'value' => 5200,
            ],
            [
                'detail_ukuran_id' => 33,
                'nama_value_ukuran' => '260',
                'value' => 5800,
            ],
            [
                'detail_ukuran_id' => 33,
                'nama_value_ukuran' => '310',
                'value' => 7000,
            ],
            [
                'detail_ukuran_id' => 33,
                'nama_value_ukuran' => '400',
                'value' => 8800,
            ],

            // Tabel Brosur ukuran5
            [
                'detail_ukuran_id' => 34,
                'nama_value_ukuran' => 'width',
                'value' => 36,
            ],
            [
                'detail_ukuran_id' => 35,
                'nama_value_ukuran' => 'height',
                'value' => 39,
            ],
            [
                'detail_ukuran_id' => 36,
                'nama_value_ukuran' => 'hp',
                'value' => 4800,
            ],
            [
                'detail_ukuran_id' => 37,
                'nama_value_ukuran' => 'plano',
                'value' => 79,
            ],
            [
                'detail_ukuran_id' => 37,
                'nama_value_ukuran' => 'plano',
                'value' => 109,
            ],
            [
                'detail_ukuran_id' => 38,
                'nama_value_ukuran' => '120',
                'value' => 2900,
            ],
            [
                'detail_ukuran_id' => 38,
                'nama_value_ukuran' => '150',
                'value' => 3500,
            ],
            [
                'detail_ukuran_id' => 38,
                'nama_value_ukuran' => '190',
                'value' => 4400,
            ],
            [
                'detail_ukuran_id' => 38,
                'nama_value_ukuran' => '210',
                'value' => 4800,
            ],
            [
                'detail_ukuran_id' => 38,
                'nama_value_ukuran' => '230',
                'value' => 5200,
            ],
            [
                'detail_ukuran_id' => 38,
                'nama_value_ukuran' => '260',
                'value' => 5800,
            ],
            [
                'detail_ukuran_id' => 38,
                'nama_value_ukuran' => '310',
                'value' => 7000,
            ],
            [
                'detail_ukuran_id' => 38,
                'nama_value_ukuran' => '400',
                'value' => 8800,
            ],

            // Tabel Brosur ukuran6
            [
                'detail_ukuran_id' => 39,
                'nama_value_ukuran' => 'width',
                'value' => 35,
            ],
            [
                'detail_ukuran_id' => 40,
                'nama_value_ukuran' => 'height',
                'value' => 44,
            ],
            [
                'detail_ukuran_id' => 41,
                'nama_value_ukuran' => 'hp',
                'value' => 4800,
            ],
            [
                'detail_ukuran_id' => 42,
                'nama_value_ukuran' => 'plano',
                'value' => 79,
            ],
            [
                'detail_ukuran_id' => 42,
                'nama_value_ukuran' => 'plano',
                'value' => 109,
            ],
            [
                'detail_ukuran_id' => 43,
                'nama_value_ukuran' => '120',
                'value' => 2900,
            ],
            [
                'detail_ukuran_id' => 43,
                'nama_value_ukuran' => '150',
                'value' => 3500,
            ],
            [
                'detail_ukuran_id' => 43,
                'nama_value_ukuran' => '190',
                'value' => 4400,
            ],
            [
                'detail_ukuran_id' => 43,
                'nama_value_ukuran' => '210',
                'value' => 4800,
            ],
            [
                'detail_ukuran_id' => 43,
                'nama_value_ukuran' => '230',
                'value' => 5200,
            ],
            [
                'detail_ukuran_id' => 43,
                'nama_value_ukuran' => '260',
                'value' => 5800,
            ],
            [
                'detail_ukuran_id' => 43,
                'nama_value_ukuran' => '310',
                'value' => 7000,
            ],
            [
                'detail_ukuran_id' => 43,
                'nama_value_ukuran' => '400',
                'value' => 8800,
            ],
            
            // Tabel Undangan ukuran1
            [
                'detail_ukuran_id' => 44,
                'nama_value_ukuran' => 'width',
                'value' => 30.5,
            ],
            [
                'detail_ukuran_id' => 45,
                'nama_value_ukuran' => 'height',
                'value' => 46,
            ],
            [
                'detail_ukuran_id' => 46,
                'nama_value_ukuran' => 'hp',
                'value' => 3200,
            ],
            [
                'detail_ukuran_id' => 47,
                'nama_value_ukuran' => 'plano',
                'value' => 61,
            ],
            [
                'detail_ukuran_id' => 47,
                'nama_value_ukuran' => 'plano',
                'value' => 92,
            ],
            [
                'detail_ukuran_id' => 48,
                'nama_value_ukuran' => '120',
                'value' => 2000,
            ],
            [
                'detail_ukuran_id' => 48,
                'nama_value_ukuran' => '150',
                'value' => 2300,
            ],
            [
                'detail_ukuran_id' => 48,
                'nama_value_ukuran' => '190',
                'value' => 2950,
            ],
            [
                'detail_ukuran_id' => 48,
                'nama_value_ukuran' => '210',
                'value' => 3200,
            ],
            [
                'detail_ukuran_id' => 48,
                'nama_value_ukuran' => '230',
                'value' => 3500,
            ],

            // Tabel Undangan ukuran2
            [
                'detail_ukuran_id' => 49,
                'nama_value_ukuran' => 'width',
                'value' => 32.5,
            ],
            [
                'detail_ukuran_id' => 50,
                'nama_value_ukuran' => 'height',
                'value' => 45,
            ],
            [
                'detail_ukuran_id' => 51,
                'nama_value_ukuran' => 'hp',
                'value' => 3400,
            ],
            [
                'detail_ukuran_id' => 52,
                'nama_value_ukuran' => 'plano',
                'value' => 65,
            ],
            [
                'detail_ukuran_id' => 52,
                'nama_value_ukuran' => 'plano',
                'value' => 90,
            ],
            [
                'detail_ukuran_id' => 53,
                'nama_value_ukuran' => '120',
                'value' => 2100,
            ],
            [
                'detail_ukuran_id' => 53,
                'nama_value_ukuran' => '150',
                'value' => 2450,
            ],
            [
                'detail_ukuran_id' => 53,
                'nama_value_ukuran' => '190',
                'value' => 3050,
            ],
            [
                'detail_ukuran_id' => 53,
                'nama_value_ukuran' => '210',
                'value' => 3400,
            ],
            [
                'detail_ukuran_id' => 53,
                'nama_value_ukuran' => '230',
                'value' => 3600,
            ],
            [
                'detail_ukuran_id' => 53,
                'nama_value_ukuran' => '260',
                'value' => 4050,
            ],
            [
                'detail_ukuran_id' => 53,
                'nama_value_ukuran' => '310',
                'value' => 4800,
            ],

            // Tabel Undangan ukuran3
            [
                'detail_ukuran_id' => 54,
                'nama_value_ukuran' => 'width',
                'value' => 32.5,
            ],
            [
                'detail_ukuran_id' => 55,
                'nama_value_ukuran' => 'height',
                'value' => 50,
            ],
            [
                'detail_ukuran_id' => 56,
                'nama_value_ukuran' => 'hp',
                'value' => 3700,
            ],
            [
                'detail_ukuran_id' => 57,
                'nama_value_ukuran' => 'plano',
                'value' => 65,
            ],
            [
                'detail_ukuran_id' => 57,
                'nama_value_ukuran' => 'plano',
                'value' => 100,
            ],
            [
                'detail_ukuran_id' => 58,
                'nama_value_ukuran' => '120',
                'value' => 2250,
            ],
            [
                'detail_ukuran_id' => 58,
                'nama_value_ukuran' => '150',
                'value' => 2700,
            ],
            [
                'detail_ukuran_id' => 58,
                'nama_value_ukuran' => '190',
                'value' => 3400,
            ],
            [
                'detail_ukuran_id' => 58,
                'nama_value_ukuran' => '210',
                'value' => 3700,
            ],
            [
                'detail_ukuran_id' => 58,
                'nama_value_ukuran' => '230',
                'value' => 4000,
            ],
            [
                'detail_ukuran_id' => 58,
                'nama_value_ukuran' => '260',
                'value' => 4500,
            ],
            [
                'detail_ukuran_id' => 58,
                'nama_value_ukuran' => '310',
                'value' => 5200,
            ],

            // Tabel Undangan ukuran4
            [
                'detail_ukuran_id' => 59,
                'nama_value_ukuran' => 'width',
                'value' => 39.5,
            ],
            [
                'detail_ukuran_id' => 60,
                'nama_value_ukuran' => 'height',
                'value' => 54.5,
            ],
            [
                'detail_ukuran_id' => 61,
                'nama_value_ukuran' => 'hp',
                'value' => 4800,
            ],
            [
                'detail_ukuran_id' => 62,
                'nama_value_ukuran' => 'plano',
                'value' => 79,
            ],
            [
                'detail_ukuran_id' => 62,
                'nama_value_ukuran' => 'plano',
                'value' => 109,
            ],
            [
                'detail_ukuran_id' => 63,
                'nama_value_ukuran' => '120',
                'value' => 2900,
            ],
            [
                'detail_ukuran_id' => 63,
                'nama_value_ukuran' => '150',
                'value' => 3500,
            ],
            [
                'detail_ukuran_id' => 63,
                'nama_value_ukuran' => '190',
                'value' => 4400,
            ],
            [
                'detail_ukuran_id' => 63,
                'nama_value_ukuran' => '210',
                'value' => 4800,
            ],
            [
                'detail_ukuran_id' => 63,
                'nama_value_ukuran' => '230',
                'value' => 5200,
            ],
            [
                'detail_ukuran_id' => 63,
                'nama_value_ukuran' => '260',
                'value' => 5800,
            ],
            [
                'detail_ukuran_id' => 63,
                'nama_value_ukuran' => '310',
                'value' => 7000,
            ],
            [
                'detail_ukuran_id' => 63,
                'nama_value_ukuran' => '400',
                'value' => 8800,
            ],

            // Tabel Undangan ukuran5
            [
                'detail_ukuran_id' => 64,
                'nama_value_ukuran' => 'width',
                'value' => 36,
            ],
            [
                'detail_ukuran_id' => 65,
                'nama_value_ukuran' => 'height',
                'value' => 39,
            ],
            [
                'detail_ukuran_id' => 66,
                'nama_value_ukuran' => 'hp',
                'value' => 4800,
            ],
            [
                'detail_ukuran_id' => 67,
                'nama_value_ukuran' => 'plano',
                'value' => 79,
            ],
            [
                'detail_ukuran_id' => 67,
                'nama_value_ukuran' => 'plano',
                'value' => 109,
            ],
            [
                'detail_ukuran_id' => 68,
                'nama_value_ukuran' => '120',
                'value' => 2900,
            ],
            [
                'detail_ukuran_id' => 68,
                'nama_value_ukuran' => '150',
                'value' => 3500,
            ],
            [
                'detail_ukuran_id' => 68,
                'nama_value_ukuran' => '190',
                'value' => 4400,
            ],
            [
                'detail_ukuran_id' => 68,
                'nama_value_ukuran' => '210',
                'value' => 4800,
            ],
            [
                'detail_ukuran_id' => 68,
                'nama_value_ukuran' => '230',
                'value' => 5200,
            ],
            [
                'detail_ukuran_id' => 68,
                'nama_value_ukuran' => '260',
                'value' => 5800,
            ],
            [
                'detail_ukuran_id' => 68,
                'nama_value_ukuran' => '310',
                'value' => 7000,
            ],
            [
                'detail_ukuran_id' => 68,
                'nama_value_ukuran' => '400',
                'value' => 8800,
            ],

            // Tabel Undangan ukuran6
            [
                'detail_ukuran_id' => 69,
                'nama_value_ukuran' => 'width',
                'value' => 35,
            ],
            [
                'detail_ukuran_id' => 70,
                'nama_value_ukuran' => 'height',
                'value' => 44,
            ],
            [
                'detail_ukuran_id' => 71,
                'nama_value_ukuran' => 'hp',
                'value' => 4800,
            ],
            [
                'detail_ukuran_id' => 72,
                'nama_value_ukuran' => 'plano',
                'value' => 79,
            ],
            [
                'detail_ukuran_id' => 72,
                'nama_value_ukuran' => 'plano',
                'value' => 109,
            ],
            [
                'detail_ukuran_id' => 73,
                'nama_value_ukuran' => '120',
                'value' => 2900,
            ],
            [
                'detail_ukuran_id' => 73,
                'nama_value_ukuran' => '150',
                'value' => 3500,
            ],
            [
                'detail_ukuran_id' => 73,
                'nama_value_ukuran' => '190',
                'value' => 4400,
            ],
            [
                'detail_ukuran_id' => 73,
                'nama_value_ukuran' => '210',
                'value' => 4800,
            ],
            [
                'detail_ukuran_id' => 73,
                'nama_value_ukuran' => '230',
                'value' => 5200,
            ],
            [
                'detail_ukuran_id' => 73,
                'nama_value_ukuran' => '260',
                'value' => 5800,
            ],
            [
                'detail_ukuran_id' => 73,
                'nama_value_ukuran' => '310',
                'value' => 7000,
            ],
            [
                'detail_ukuran_id' => 73,
                'nama_value_ukuran' => '400',
                'value' => 8800,
            ],


            // Tabel Kalender ukuran1
            [
                'detail_ukuran_id' => 74,
                'nama_value_ukuran' => 'width',
                'value' => 39.5,
            ],
            [
                'detail_ukuran_id' => 75,
                'nama_value_ukuran' => 'height',
                'value' => 54.5,
            ],
            [
                'detail_ukuran_id' => 76,
                'nama_value_ukuran' => 'hp',
                'value' => 4800,
            ],
            [
                'detail_ukuran_id' => 77,
                'nama_value_ukuran' => 'plano',
                'value' => 79,
            ],
            [
                'detail_ukuran_id' => 77,
                'nama_value_ukuran' => 'plano',
                'value' => 109,
            ],
            [
                'detail_ukuran_id' => 78,
                'nama_value_ukuran' => '120',
                'value' => 2900,
            ],
            [
                'detail_ukuran_id' => 78,
                'nama_value_ukuran' => '150',
                'value' => 3500,
            ],


            // Tabel Kalender ukuran2
            [
                'detail_ukuran_id' => 79,
                'nama_value_ukuran' => 'width',
                'value' => 36,
            ],
            [
                'detail_ukuran_id' => 80,
                'nama_value_ukuran' => 'height',
                'value' => 52,
            ],
            [
                'detail_ukuran_id' => 81,
                'nama_value_ukuran' => 'hp',
                'value' => 3500,
            ],
            [
                'detail_ukuran_id' => 82,
                'nama_value_ukuran' => 'plano',
                'value' => 72,
            ],
            [
                'detail_ukuran_id' => 82,
                'nama_value_ukuran' => 'plano',
                'value' => 104,
            ],
            [
                'detail_ukuran_id' => 83,
                'nama_value_ukuran' => '120',
                'value' => 2500,
            ],
            [
                'detail_ukuran_id' => 83,
                'nama_value_ukuran' => '150',
                'value' => 3000,
            ],

        ];

        DB::table('detail_value_ukuran')->insert($detailValueUkuran);
    }
}
