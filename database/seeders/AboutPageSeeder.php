<?php

namespace Database\Seeders;

use App\Models\AboutPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aboutPage = [
            [
                'image' => 'anesh_printing_1.png',
                'description' => 'Percetakan Anesh Printing merupakan usaha jasa dibidang percetakan, percetakan ini berdiri dari tahun 2016. Percetakan Anesh Printing berlokasi di Jl. Teuku Umar No.2, Pasir Gintung, Kec. Tj. Karang Pusat, Kota Bandar Lampung, Lampung. Percetakan Anesh Printing pada saat ini memiliki jasa untuk cetak undangan, majalah, tabloid, buku, kalender, dan lain-lain.'
            ]
        ];
        AboutPage::query()->insert($aboutPage);
    }
}
