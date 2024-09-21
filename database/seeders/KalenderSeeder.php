<?php

namespace Database\Seeders;

use App\Models\Kalender;
use App\Models\Transaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KalenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $transaksi = Transaksi::create([
            'user_id' => 2,
            'nomor_pesanan' => '1234',
            'produk_id' => 3,
            'alamat' => 'jalan raya',
            'harga_plano' => '2300',
            'jml_total' => '55',
            'total_harga' => '450.000',
            'gramasi' => '120gr',
            'laminasi' => 'Glossy Bolak-Balik',
            'gambar' => 'undangan.jpg',
            'status' => 'Pesanan Diproses',
        ]);

        $transaksi->kalender()->create([
            'lembar' => 12,
            'jilid' => 'kaleng',
            'uk_asli' => '79 x 109',
            'uk_width' => '15,5',
            'uk_height' => '25',
        ]);
    }
}
