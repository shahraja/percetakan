<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaksi>
 */
class TransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'user_id' => 2, 
        'nomor_pesanan' => $this->faker->unique()->numberBetween(1000000000, 9999999999),
        'produk_id' => 1, 
        'alamat' => $this->faker->address(), 
        'harga_plano' => 2300, 
        'jml_total' => 12, 
        'total_harga' => 1200000,
        'gramasi' => 150, 
        'laminasi' => 'glossy1',
        'gambar' => null,
        'metode_pengambilan' => $this->faker->randomElement([0, 1]),
        'status' => 'Diproses',
        ];
    }
}
