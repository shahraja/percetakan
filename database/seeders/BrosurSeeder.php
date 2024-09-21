<?php

namespace Database\Seeders;

use App\Models\Brosur;
use App\Models\Transaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrosurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $transaksi = Transaksi::create([
            'user_id' => 2,
            'nomor_pesanan' => '2345',
            'produk_id' => 2,
            'alamat' => 'jalan raya',
            'harga_plano' => '2300',
            'jml_total' => '55',
            'total_harga' => '450.000',
            'gramasi' => '120gr',
            'laminasi' => 'Glossy ',
            'gambar' => 'undangan.jpg',
            'status' => 'Pesanan Diproses',
        ]);

        $transaksi->brosur()->create([
            'uk_asli' => '79 x 109',
            'uk_width' => '15,5',
            'uk_height' => '25',
        ]);
        // $brosur = [
        //     [
        //         'transaksi_id' => 1,
        //         'uk_asli' => '79 x 109',
        //         'uk_width' => '32,5',
        //         'uk_height' => '52',
        //     ],
        // ];
        // Brosur::query()->insert($brosur);
    }
}
