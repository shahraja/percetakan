<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use App\Models\Undangan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UndanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $transaksi = Transaksi::create([
            'user_id' => 2,
            'nomor_pesanan' => '1234',
            'produk_id' => 4,
            'alamat' => 'jalan raya',
            'harga_plano' => '2300',
            'jml_total' => '55',
            'total_harga' => '450.000',
            'gramasi' => '120gr',
            'laminasi' => 'Glossy Bolak-Balik',
            'gambar' => 'undangan.jpg',
            'status' => 'Diproses',
        ]);

        $transaksi->undangan()->create([
            'uk_asli' => '60 x 80',
            'uk_width' => '25,5',
            'uk_height' => '25',
        ]);
        // $undangan = [
        //     [
        //         'transaksi_id' => 5,
        //         'uk_asli' => '60 x 80',
        //         'uk_width' => '35,5',
        //         'uk_height' => '42',
        //     ],
        // ];
        // Undangan::query()->insert($undangan);
    }
}
