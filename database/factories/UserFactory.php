<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // return [
        //     'name' => fake()->name(),
        //     'email' => fake()->unique()->safeEmail(),
        //     'password' => static::$password ??= Hash::make('password'),
        // ];

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'role' => 2,
            'no_telp' => $this->faker->unique()->numberBetween(1000000000, 9999999999),
            'alamat' => $this->faker->address(),
            'provinsi' => $this->faker->city(),
            'kota' => $this->faker->city(),
            'kecamatan' => $this->faker->streetAddress(),
            'password' => Hash::make('password'), // password
            // 'remember_token' => Str::random(10),
        ];
    }

}
