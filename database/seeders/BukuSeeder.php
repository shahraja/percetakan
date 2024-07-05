<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Transaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transaksi = Transaksi::create([
            'user_id' => 2,
            'nomor_pesanan' => '1234',
            'produk_id' => 1,
            'alamat' => 'jalan raya',
            'harga_plano' => '2300',
            'jml_total' => '55',
            'total_harga' => '450.000',
            'gramasi' => '120gr',
            'laminasi' => 'Glossy Bolak-Balik',
            'gambar' => 'undangan.jpg',
            'status' => 'Diproses',
        ]);

        $transaksi->buku()->create([
            'halaman' => 29,
            'finishing' => 'Doff',
            'uk_asli' => '79 x 109',
            'uk_width' => '15,5',
            'uk_height' => '25',
        ]);
        
        // $buku = [
        //     [
        //         'transaksi_id' => 2,
        //         'halaman' => 29,
        //         'finishing' => 'Doff',
        //         'uk_asli' => '79 x 109',
        //         'uk_width' => '15,5',
        //         'uk_height' => '25',
        //     ],
        // ];
        // Buku::query()->insert($buku);
    }
}
