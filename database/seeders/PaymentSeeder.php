<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payment = [
            [
                'token_user' => 'bebas',
                'tgl_transaksi' => '21/1/2002',
                'nama' => 'tirex',
                'produk' => 'banner',
                'waktu' => '19.00',
                'gambar' => 'logo-1.png',
                'status' => 'Menunggu Konfirmasi',
            ],
            [
                'token_user' => 'kibas',
                'tgl_transaksi' => '21/1/2001',
                'nama' => 'tirex 3',
                'produk' => 'banner',
                'waktu' => '19.10',
                'gambar' => 'logo-2.png',
                'status' => 'Menunggu Konfirmasi',
            ],
            ];
            Payment::query()->insert($payment);
    }
}
