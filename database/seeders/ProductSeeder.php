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
                'judul' => 'Buku',
                'kertas' => 'A5',
                'gambar' => 'buku-1.jpg',
                'deskripsi' => 'Mencetak buku adalah cara efektif untuk berbagi pengetahuan, cerita, atau panduan dengan audiens yang lebih luas. Buku dapat berfungsi sebagai sumber informasi yang mendalam dan komprehensif, menjelaskan topik atau kisah secara terperinci kepada pembaca. Dengan fleksibilitas dalam desain dan format, buku dapat disesuaikan dengan berbagai kebutuhan dan selera, baik untuk keperluan edukasi, hiburan, atau referensi. Percetakanbandung.com menyediakan layanan cetak buku berkualitas tinggi yang sesuai dengan anggaran Anda, memastikan setiap halaman tampil dengan sempurna dan menarik perhatian pembaca.',
                'harga' => 55000,
                'sisi' => '2 sisi',
                'ukuran' => '100 x 100'
            ],
            [
                'judul' => 'Brosur',
                'kertas' => 'A7',
                'gambar' => 'brosur-1.jpg',
                'deskripsi' => 'Mencetak brosur adalah strategi efektif untuk meningkatkan bisnis, baik skala besar maupun kecil. Brosur berperan sebagai panduan dalam menjelaskan produk dan layanan, serta menyoroti fitur dan manfaat utamanya kepada pelanggan. Sebagai salah satu alat pemasaran yang fleksibel, brosur sesuai digunakan dalam berbagai konteks, bahkan bagi bisnis dengan anggaran terbatas. Percetakanbandung.com menawarkan solusi cetak brosur berkualitas tinggi dengan harga yang ramah di kantong.',
                'harga' => 5500,
                'sisi' => '2 sisi',
                'ukuran' => '100 x 100'
            ],
            [
                'judul' => 'Kalender',
                'kertas' => 'A2',
                'gambar' => 'kalender-1.jpg',
                'deskripsi' => 'Kalender cetak merupakan alat praktis yang tidak hanya membantu mengatur waktu tetapi juga berfungsi sebagai media promosi yang efektif. Dengan menampilkan produk, layanan, atau pesan khusus setiap bulannya, kalender dapat mengingatkan pelanggan tentang bisnis Anda sepanjang tahun. Kalender juga menawarkan fleksibilitas dalam desain, memungkinkan untuk disesuaikan dengan branding perusahaan atau tema tertentu. Percetakanbandung.com menawarkan solusi cetak kalender berkualitas tinggi dengan harga terjangkau, memastikan setiap kalender menjadi alat yang berguna dan menarik bagi pelanggan Anda.',
                'harga' => 50000,
                'sisi' => '2 sisi',
                'ukuran' => '100 x 100'
            ],
            [
                'judul' => 'Undangan',
                'kertas' => 'A8',
                'gambar' => 'undangan-1.jpg',
                'deskripsi' => 'Undangan cetak merupakan elemen penting dalam menyampaikan kesan pertama yang tak terlupakan untuk berbagai acara, mulai dari pernikahan, pesta ulang tahun, hingga acara perusahaan. Undangan berfungsi sebagai panduan yang menginformasikan detail acara, serta menyoroti tema dan suasana yang diharapkan. Dengan desain yang kreatif dan personalisasi yang tepat, undangan dapat mencerminkan karakter acara dan menarik minat para tamu. Percetakanbandung.com menyediakan layanan cetak undangan berkualitas tinggi yang ramah di kantong, memastikan setiap undangan tampak elegan dan profesional.',
                'harga' => 500,
                'sisi' => '2 sisi',
                'ukuran' => '100 x 100'
            ],
            [
                'judul' => 'Majalah',
                'kertas' => 'A7',
                'gambar' => 'majalah-1.jpg',
                'deskripsi' => 'Mencetak majalah adalah cara efektif untuk menginformasikan, menginspirasi, dan menghibur pembaca dengan berbagai konten menarik. Majalah dapat berfungsi sebagai platform untuk berbagi artikel, foto, dan iklan yang relevan dengan audiens target. Dengan fleksibilitas dalam format dan desain, majalah dapat disesuaikan dengan berbagai industri dan minat, menawarkan pengalaman membaca yang kaya dan mendalam. Percetakanbandung.com menyediakan solusi cetak majalah berkualitas tinggi yang sesuai dengan anggaran Anda, memastikan setiap edisi tampil dengan estetika yang menawan dan kualitas cetak yang luar biasa.',
                'harga' => 10000,
                'sisi' => '2 sisi',
                'ukuran' => '100 x 100'
            ],
        ];
        Product::query()->insert($product);
    }
}
