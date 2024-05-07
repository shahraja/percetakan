<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = [
            [
                'judul' => 'Banner',
                'kertas' => 'A4',
                'gambar' => 'undangan.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora laboriosam provident repellendus, optio libero ab esse nisi eaque? Sunt blanditiis soluta quaerat non mollitia! Vel ex nisi id in ut.',
                'harga' => 45000,
                'sisi' => '2 sisi',
                'ukuran' => '100 x 100'
            ],
            [
                'judul' => 'Spanduk',
                'kertas' => 'A5',
                'gambar' => 'undangan.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora laboriosam provident repellendus, optio libero ab esse nisi eaque? Sunt blanditiis soluta quaerat non mollitia! Vel ex nisi id in ut.',
                'harga' => 5000,
                'sisi' => '2 sisi',
                'ukuran' => '100 x 100'
            ],
            [
                'judul' => 'Buku',
                'kertas' => 'A5',
                'gambar' => 'undangan.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora laboriosam provident repellendus, optio libero ab esse nisi eaque? Sunt blanditiis soluta quaerat non mollitia! Vel ex nisi id in ut.',
                'harga' => 55000,
                'sisi' => '2 sisi',
                'ukuran' => '100 x 100'
            ],
            [
                'judul' => 'Brosur',
                'kertas' => 'A7',
                'gambar' => 'undangan.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora laboriosam provident repellendus, optio libero ab esse nisi eaque? Sunt blanditiis soluta quaerat non mollitia! Vel ex nisi id in ut.',
                'harga' => 5500,
                'sisi' => '2 sisi',
                'ukuran' => '100 x 100'
            ],
            [
                'judul' => 'Kalender',
                'kertas' => 'A2',
                'gambar' => 'kalender.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora laboriosam provident repellendus, optio libero ab esse nisi eaque? Sunt blanditiis soluta quaerat non mollitia! Vel ex nisi id in ut.',
                'harga' => 50000,
                'sisi' => '2 sisi',
                'ukuran' => '100 x 100'
            ],
            [
                'judul' => 'Kardus',
                'kertas' => 'A10',
                'gambar' => 'undangan.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora laboriosam provident repellendus, optio libero ab esse nisi eaque? Sunt blanditiis soluta quaerat non mollitia! Vel ex nisi id in ut.',
                'harga' => 55000,
                'sisi' => '2 sisi',
                'ukuran' => '100 x 100'
            ],
            [
                'judul' => 'Undangan',
                'kertas' => 'A8',
                'gambar' => 'undangan.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora laboriosam provident repellendus, optio libero ab esse nisi eaque? Sunt blanditiis soluta quaerat non mollitia! Vel ex nisi id in ut.',
                'harga' => 500,
                'sisi' => '2 sisi',
                'ukuran' => '100 x 100'
            ],
            [
                'judul' => 'Majalah',
                'kertas' => 'A7',
                'gambar' => 'undangan.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora laboriosam provident repellendus, optio libero ab esse nisi eaque? Sunt blanditiis soluta quaerat non mollitia! Vel ex nisi id in ut.',
                'harga' => 10000,
                'sisi' => '2 sisi',
                'ukuran' => '100 x 100'
            ],
            [
                'judul' => 'packing',
                'kertas' => 'A5',
                'gambar' => 'undangan.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora laboriosam provident repellendus, optio libero ab esse nisi eaque? Sunt blanditiis soluta quaerat non mollitia! Vel ex nisi id in ut.',
                'harga' => 57000,
                'sisi' => '2 sisi',
                'ukuran' => '100 x 100'
            ],
            [
                'judul' => 'Spanduk 2',
                'kertas' => 'A2',
                'gambar' => 'undangan.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora laboriosam provident repellendus, optio libero ab esse nisi eaque? Sunt blanditiis soluta quaerat non mollitia! Vel ex nisi id in ut.',
                'harga' => 55000,
                'sisi' => '2 sisi',
                'ukuran' => '100 x 100'
            ],
            [
                'judul' => 'Spanduk 5',
                'kertas' => 'A5',
                'gambar' => 'undangan.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora laboriosam provident repellendus, optio libero ab esse nisi eaque? Sunt blanditiis soluta quaerat non mollitia! Vel ex nisi id in ut.',
                'harga' => 9000,
                'sisi' => '2 sisi',
                'ukuran' => '100 x 100'
            ],
            [
                'judul' => 'Spanduk 10',
                'kertas' => 'A10',
                'gambar' => 'undangan.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora laboriosam provident repellendus, optio libero ab esse nisi eaque? Sunt blanditiis soluta quaerat non mollitia! Vel ex nisi id in ut.',
                'harga' => 5500,
                'sisi' => '2 sisi',
                'ukuran' => '100 x 100'
            ],
        ];
        Product::query()->insert($product);
    }
}
