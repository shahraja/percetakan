<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('feedback')->insert([
            [
                'name' => 'John Doe',
                'img' => 'testimonial-1.jpg',
                'review' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis blanditiis excepturi quisquam temporibus voluptatum reprehenderit culpa, quasi corrupti laborum accusamus.',
                'rating' => 5
            ],
            [
                'name' => 'Jane Smith',
                'img' => 'testimonial-2.jpg',
                'review' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis blanditiis excepturi quisquam temporibus voluptatum reprehenderit culpa, quasi corrupti laborum accusamus.',
                'rating' => 5
            ],
            [
                'name' => 'Michael Scott',
                'img' => 'testimonial-3.jpg',
                'review' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis blanditiis excepturi quisquam temporibus voluptatum reprehenderit culpa, quasi corrupti laborum accusamus.',
                'rating' => 5
            ],
            [
                'name' => 'Pam Beesly',
                'img' => 'testimonial-2.jpg',
                'review' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis blanditiis excepturi quisquam temporibus voluptatum reprehenderit culpa, quasi corrupti laborum accusamus.',
                'rating' => 5
            ],
        ]);
    }
}
