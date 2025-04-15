<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Marque>
 */
class MarqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $marques = [
            'Apple',
            'Samsung',
            'Sony',
            'LG',
            'Nike',
            'Adidas',
            'Puma',
            'Zara',
            'Chanel',
            'L\'Oréal',
            'Peugeot',
            'Renault',
            'Nestlé',
            'Danone',
            'Nespresso',
            'Microsoft',
            'Google',
            'Amazon',
            'Ikea',
            'Bosch',
        ];

        return [
            'marque' => $this->faker->randomElement($marques),
        ];
    }
}
