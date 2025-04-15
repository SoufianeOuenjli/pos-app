<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Famille>
 */
class FamilleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $familles = [
            'Fruits',
            'Légumes',
            'Électronique',
            'Vêtements',
            'Chaussures',
            'Meubles',
            'Jouets',
            'Cosmétiques',
            'Produits ménagers',
            'Bricolage',
            'Papeterie',
            'Bijoux',
            'Accessoires',
            'Produits laitiers',
            'Boissons',
            'Boulangerie',
            'Charcuterie',
            'Poissonnerie',
            'Livres',
            'Informatique',
        ];

        return [
            'famille' => $this->faker->randomElement($familles),
        ];
    }
}
