<?php

namespace Database\Seeders;

use App\Models\Majalah;
use App\Models\Transaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MajalahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $transaksi = Transaksi::create([
            'user_id' => 2,
            'nomor_pesanan' => '1234',
            'produk_id' => 5,
            'alamat' => 'jalan raya',
            'harga_plano' => '2300',
            'jml_total' => '55',
            'total_harga' => '450.000',
            'gramasi' => '120gr',
            'laminasi' => 'Glossy Bolak-Balik',
            'gambar' => 'undangan.jpg',
            'status' => 'Pesanan Diproses',
        ]);

        $transaksi->majalah()->create([
            'halaman' => 46,
            'finishing' => 'Glossy',
            'uk_asli' => '60 x 100',
            'uk_width' => '35,5',
            'uk_height' => '55',
        ]);
        // $majalah = [
        //     [
        //         'transaksi_id' => 4,
        //         'halaman' => 46,
        //         'finishing' => 'Glossy',
        //         'uk_asli' => '60 x 100',
        //         'uk_width' => '35,5',
        //         'uk_height' => '55',
        //     ],
        // ];
        // Majalah::query()->insert($majalah);
    }
}
