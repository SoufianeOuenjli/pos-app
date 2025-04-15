<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $produits = [
            'iPhone 14',
            'Galaxy S22',
            'Téléviseur LED 55"',
            'Chaussures de sport',
            'Montre connectée',
            'Aspirateur sans fil',
            'Table en bois',
            'Chaise ergonomique',
            'Crème hydratante',
            'Shampoing naturel',
            'Laptop HP Pavilion',
            'Imprimante Canon',
            'Jeans slim',
            'Sweat à capuche',
            'Café en grains',
            'Lait demi-écrémé',
            'Yaourt aux fruits',
            'Jus d’orange',
            'Sac à dos',
            'Casque audio Bluetooth',
        ];

        return [
            'nom' => $this->faker->randomElement($produits),
            'code_barre' => $this->faker->unique()->ean13(),
            // 'image' => $this->faker->imageUrl(640, 480, 'food'),
            'tva' => $this->faker->randomFloat(2, 0, 20),
            'prix_ht' => $this->faker->randomFloat(2, 1, 100),
            'stock' => $this->faker->numberBetween(0, 100),
            'unite_id' => \App\Models\Unite::factory(),
            'marque_id' => \App\Models\Marque::factory(),
            'famille_id' => \App\Models\Famille::factory(),
        ];
    }
}
