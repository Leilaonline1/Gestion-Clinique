<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insérer les catégories prédéfinies
        Category::insert([
            ['name' => 'Biochimie'],
            ['name' => 'Hématologie'],
            ['name' => 'Ionogramme Sanguin'],
            ['name' => 'Sérologie'],
            ['name' => 'Hormonologie'],
            ['name' => 'Microbiologie'],
            ['name' => 'Génétique'],
        ]);
    }
}
