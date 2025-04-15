<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Commande;
use App\Models\CommandeDetail;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Unite;
use App\Models\Marque;
use App\Models\Famille;
use App\Models\ModeReglement;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Unite::factory(10)->create();
        Marque::factory(10)->create();
        Famille::factory(10)->create();
        ModeReglement::factory(10)->create();
        Article::factory(10)->create();
        // Commande::factory(10)->create();
        CommandeDetail::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
