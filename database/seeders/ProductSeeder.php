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
        $JSONBuku = [
            'A4' => [
                'width' => 21,
                'height' => 28,
                'prices' => [
                    '120' => 2000,
                    '150' => 2300,
                ],
            ],
            'A5' => [
                'width' => 14.8,
                'height' => 21,
                'prices' => [
                    '120' => 2100,
                    '150' => 2450,
                ],
            ],
        ];
        $product = [
            [
                'id' => 1,
                'judul' => 'Buku',
                'kertas' => 'A5',
                'gambar' => 'buku-1.jpg',
                'deskripsi' => 'Mencetak buku adalah cara efektif untuk berbagi pengetahuan, cerita, atau panduan dengan audiens yang lebih luas. Buku dapat berfungsi sebagai sumber informasi yang mendalam dan komprehensif, menjelaskan topik atau kisah secara terperinci kepada pembaca. Dengan fleksibilitas dalam desain dan format, buku dapat disesuaikan dengan berbagai kebutuhan dan selera, baik untuk keperluan edukasi, hiburan, atau referensi.',
                'harga' => 55000,
                'sisi' => '2 sisi',
                'ukuran' => '100 x 100',
                'spesifikasi' => json_encode($JSONBuku),
            ],
            [
                'id' => 2,
                'judul' => 'Brosur',
                'kertas' => 'A7',
                'gambar' => 'brosur-1.jpg',
                'deskripsi' => 'Mencetak brosur adalah strategi efektif untuk meningkatkan bisnis, baik skala besar maupun kecil. Brosur berperan sebagai panduan dalam menjelaskan produk dan layanan, serta menyoroti fitur dan manfaat utamanya kepada pelanggan. Sebagai salah satu alat pemasaran yang fleksibel, brosur sesuai digunakan dalam berbagai konteks, bahkan bagi bisnis dengan anggaran terbatas.',
                'harga' => 5500,
                'sisi' => '2 sisi',
                'ukuran' => '100 x 100',
                'spesifikasi' => null,
            ],
            [
                'id' => 3,
                'judul' => 'Kalender',
                'kertas' => 'A2',
                'gambar' => 'kalender-1.jpg',
                'deskripsi' => 'Kalender cetak merupakan alat praktis yang tidak hanya membantu mengatur waktu tetapi juga berfungsi sebagai media promosi yang efektif. Dengan menampilkan produk, layanan, atau pesan khusus setiap bulannya, kalender dapat mengingatkan pelanggan tentang bisnis Anda sepanjang tahun. Kalender juga menawarkan fleksibilitas dalam desain, memungkinkan untuk disesuaikan dengan branding perusahaan atau tema tertentu.',
                'harga' => 50000,
                'sisi' => '2 sisi',
                'ukuran' => '100 x 100',
                'spesifikasi' => null,
            ],
            [
                'id' => 4,
                'judul' => 'Undangan',
                'kertas' => 'A8',
                'gambar' => 'undangan-1.jpg',
                'deskripsi' => 'Undangan cetak merupakan elemen penting dalam menyampaikan kesan pertama yang tak terlupakan untuk berbagai acara, mulai dari pernikahan, pesta ulang tahun, hingga acara perusahaan. Undangan berfungsi sebagai panduan yang menginformasikan detail acara, serta menyoroti tema dan suasana yang diharapkan. Dengan desain yang kreatif dan personalisasi yang tepat, undangan dapat mencerminkan karakter acara dan menarik minat para tamu.',
                'harga' => 500,
                'sisi' => '2 sisi',
                'ukuran' => '100 x 100',
                'spesifikasi' => null,
            ],
            [
                'id' => 5,
                'judul' => 'Majalah',
                'kertas' => 'A7',
                'gambar' => 'majalah-1.jpg',
                'deskripsi' => 'Mencetak majalah adalah cara efektif untuk menginformasikan, menginspirasi, dan menghibur pembaca dengan berbagai konten menarik. Majalah dapat berfungsi sebagai platform untuk berbagi artikel, foto, dan iklan yang relevan dengan audiens target. Dengan fleksibilitas dalam format dan desain, majalah dapat disesuaikan dengan berbagai industri dan minat, menawarkan pengalaman membaca yang kaya dan mendalam.',
                'harga' => 10000,
                'sisi' => '2 sisi',
                'ukuran' => '100 x 100',
                'spesifikasi' => null,
            ],
            [
                'id' => 6,
                'judul' => 'Yasin',
                'kertas' => 'A7',
                'gambar' => 'majalah-1.jpg',
                'deskripsi' => 'Mencetak Yasin adalah cara efektif untuk menginformasikan, menginspirasi, dan menghibur pembaca dengan berbagai konten menarik. Yasin dapat berfungsi sebagai platform untuk berbagi artikel, foto, dan iklan yang relevan dengan audiens target. Dengan fleksibilitas dalam format dan desain, Yasin dapat disesuaikan dengan berbagai industri dan minat, menawarkan pengalaman membaca yang kaya dan mendalam.',
                'harga' => 10000,
                'sisi' => '2 sisi',
                'ukuran' => '100 x 100',
                'spesifikasi' => null,
            ],
            [
                'id' => 7,
                'judul' => 'Kartu Nama',
                'kertas' => 'A7',
                'gambar' => 'majalah-1.jpg',
                'deskripsi' => 'Mencetak Kartu Nama adalah cara efektif untuk menginformasikan, menginspirasi, dan menghibur pembaca dengan berbagai konten menarik. Kartu Nama dapat berfungsi sebagai platform untuk berbagi artikel, foto, dan iklan yang relevan dengan audiens target. Dengan fleksibilitas dalam format dan desain, Kartu Nama dapat disesuaikan dengan berbagai industri dan minat, menawarkan pengalaman membaca yang kaya dan mendalam.',
                'harga' => 10000,
                'sisi' => '2 sisi',
                'ukuran' => '100 x 100',
                'spesifikasi' => null,
            ],
            [
                'id' => 8,
                'judul' => 'Nota',
                'kertas' => 'A7',
                'gambar' => 'majalah-1.jpg',
                'deskripsi' => 'Mencetak Nota adalah cara efektif untuk menginformasikan, menginspirasi, dan menghibur pembaca dengan berbagai konten menarik. Nota dapat berfungsi sebagai platform untuk berbagi artikel, foto, dan iklan yang relevan dengan audiens target. Dengan fleksibilitas dalam format dan desain, Nota dapat disesuaikan dengan berbagai industri dan minat, menawarkan pengalaman membaca yang kaya dan mendalam.',
                'harga' => 10000,
                'sisi' => '2 sisi',
                'ukuran' => '100 x 100',
                'spesifikasi' => null,
            ],
        ];
        Product::query()->insert($product);
    }
}
