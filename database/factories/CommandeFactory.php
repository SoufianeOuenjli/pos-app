<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commande>
 */
class CommandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'remise' => $this->faker->randomFloat(2, 0, 100),
            'regle' => $this->faker->boolean(),
            'mode_reglement_id' => \App\Models\ModeReglement::factory(),
            'client_id' => \App\Models\User::factory(),
        ];
    }
}
