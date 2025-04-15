<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommandeDetail>
 */
class CommandeDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'commande_id' => \App\Models\Commande::factory(),
            'article_id' => \App\Models\Article::factory(),
            'prix_ht' => $this->faker->randomFloat(2, 1, 100),
            'quantite' => $this->faker->randomFloat(2, 1, 10),
            'tva' => $this->faker->randomFloat(2, 0, 20),
        ];
    }
}
