<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buku>
 */
class BukuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'transaksi_id' => 1,
            'halaman' => $this->faker->numberBetween(1, 100),
            'finishing' => $this->faker->randomElement(['binding', 'steples']),
            'uk_asli' => $this->faker->numberBetween(1, 100),
            'uk_width' => $this->faker->numberBetween(1, 100),
            'uk_height' => '61 x 92',
        ];
    }
}
