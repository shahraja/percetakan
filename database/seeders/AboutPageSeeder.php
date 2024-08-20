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
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, ipsum. Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, ipsum. '
            ]
        ];
        AboutPage::query()->insert($aboutPage);
    }
}
