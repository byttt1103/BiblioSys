<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Novela', 'about' => 'Obras de ficción narrativa en prosa.'],
            ['name' => 'Ensayo', 'about' => 'Textos de reflexión, crítica o divulgación.'],
            ['name' => 'Poesía', 'about' => 'Obras en verso y lírica.'],
            ['name' => 'Teatro', 'about' => 'Obras dramáticas para representación.'],
            ['name' => 'Cuento', 'about' => 'Narrativa breve.'],
            ['name' => 'No ficción', 'about' => 'Biografías, historia, divulgación científica.'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                ['about' => $category['about']]
            );
        }
    }
}
