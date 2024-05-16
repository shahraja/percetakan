<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cart = [
            [
                'no_pesanan' => '123mamak',
                'nama' => 'raja',
                'alamat' => 'jalan tirtayasa',
                'nama_produk' => 'Banner A4',
                'sisi' => '2 Sisi',
                'ukuran' => '100 x 100',
                'jumlah_total' => '420000',
                'lipat' => '4',
                'harga' => '1500',
                'laminasi' => 'Laminasi',
                'status' => 'Menunggu Konfirmasi',
            ],
            [
                'no_pesanan' => '456bapak',
                'nama' => 'juju',
                'alamat' => 'jalan titus bonay',
                'nama_produk' => 'Banner A5',
                'sisi' => '4',
                'ukuran' => '200 x 200',
                'jumlah_total' => '500000',
                'lipat' => '4',
                'harga' => '2000',
                'laminasi' => 'Tidak Laminasi',
                'status' => 'Menunggu Konfirmasi',
            ],
        ];
        Cart::query()->insert($cart);
    }
}
