<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transaksi = [
            [
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
            ],
            [
                'user_id' => 2,
                'nomor_pesanan' => '1234',
                'produk_id' => 2,
                'alamat' => 'jalan raya',
                'harga_plano' => '2300',
                'jml_total' => '55',
                'total_harga' => '450.000',
                'gramasi' => '120gr',
                'laminasi' => 'Glossy Bolak-Balik',
                'gambar' => 'undangan.jpg',
                'status' => 'Diproses',
            ],
            [
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
                'status' => 'Diproses',
            ],
            [
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
            ],
            [
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
                'status' => 'Diproses',
            ],
        ];
        Transaksi::query()->insert($transaksi);
    }
}
