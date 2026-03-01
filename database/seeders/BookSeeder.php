<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            ['category_id' => 1, 'title' => 'Cien años de soledad', 'cover_path' => 'covers/cien-anos.jpg', 'publisher' => 'Editorial Sudamericana', 'publication_year' => 1967],
            ['category_id' => 1, 'title' => 'Don Quijote de la Mancha', 'cover_path' => 'covers/quijote.jpg', 'publisher' => 'Francisco de Robles', 'publication_year' => 1605],
            ['category_id' => 1, 'title' => 'El amor en los tiempos del cólera', 'cover_path' => 'covers/amor-colera.jpg', 'publisher' => 'Editorial Oveja Negra', 'publication_year' => 1985],
            ['category_id' => 1, 'title' => 'Rayuela', 'cover_path' => 'covers/rayuela.jpg', 'publisher' => 'Editorial Sudamericana', 'publication_year' => 1963],
            ['category_id' => 1, 'title' => 'Pedro Páramo', 'cover_path' => 'covers/pedro-paramo.jpg', 'publisher' => 'Fondo de Cultura Económica', 'publication_year' => 1955],
            ['category_id' => 1, 'title' => 'La casa de los espíritus', 'cover_path' => 'covers/casa-espiritus.jpg', 'publisher' => 'Editorial Sudamericana', 'publication_year' => 1982],
            ['category_id' => 1, 'title' => 'El túnel', 'cover_path' => 'covers/tunel.jpg', 'publisher' => 'Editorial Sur', 'publication_year' => 1948],
            ['category_id' => 1, 'title' => 'Ficciones', 'cover_path' => 'covers/ficciones.jpg', 'publisher' => 'Editorial Sur', 'publication_year' => 1944],
            ['category_id' => 1, 'title' => 'El aleph', 'cover_path' => 'covers/aleph.jpg', 'publisher' => 'Editorial Losada', 'publication_year' => 1949],
            ['category_id' => 1, 'title' => 'Como agua para chocolate', 'cover_path' => 'covers/chocolate.jpg', 'publisher' => 'Editorial Planeta', 'publication_year' => 1989],
            ['category_id' => 1, 'title' => 'El laberinto de la soledad', 'cover_path' => 'covers/laberinto.jpg', 'publisher' => 'Fondo de Cultura Económica', 'publication_year' => 1950],
            ['category_id' => 1, 'title' => 'La ciudad y los perros', 'cover_path' => 'covers/ciudad-perros.jpg', 'publisher' => 'Editorial Seix Barral', 'publication_year' => 1963],
            ['category_id' => 1, 'title' => 'Conversación en La Catedral', 'cover_path' => 'covers/catedral.jpg', 'publisher' => 'Editorial Seix Barral', 'publication_year' => 1969],
            ['category_id' => 1, 'title' => 'El otoño del patriarca', 'cover_path' => 'covers/otono-patriarca.jpg', 'publisher' => 'Editorial Plaza & Janés', 'publication_year' => 1975],
            ['category_id' => 1, 'title' => 'Crónica de una muerte anunciada', 'cover_path' => 'covers/cronica-muerte.jpg', 'publisher' => 'Editorial La Oveja Negra', 'publication_year' => 1981],
            ['category_id' => 1, 'title' => 'El general en su laberinto', 'cover_path' => 'covers/general-laberinto.jpg', 'publisher' => 'Editorial Oveja Negra', 'publication_year' => 1989],
            ['category_id' => 2, 'title' => 'Sobre la literatura', 'cover_path' => 'covers/sobre-literatura.jpg', 'publisher' => 'Tusquets', 'publication_year' => 2004],
            ['category_id' => 1, 'title' => 'Los detectives salvajes', 'cover_path' => 'covers/detectives-salvajes.jpg', 'publisher' => 'Anagrama', 'publication_year' => 1998],
            ['category_id' => 1, 'title' => '2666', 'cover_path' => 'covers/2666.jpg', 'publisher' => 'Anagrama', 'publication_year' => 2004],
            ['category_id' => 1, 'title' => 'El obsceno pájaro de la noche', 'cover_path' => 'covers/pajaro-noche.jpg', 'publisher' => 'Editorial Seix Barral', 'publication_year' => 1970],
            ['category_id' => 1, 'title' => 'La tregua', 'cover_path' => 'covers/tregua.jpg', 'publisher' => 'Editorial Alfa', 'publication_year' => 1960],
        ];

        foreach ($books as $data) {
            Book::firstOrCreate(
                [
                    'title' => $data['title'],
                    'publication_year' => $data['publication_year'],
                ],
                [
                    'category_id' => $data['category_id'],
                    'cover_path' => $data['cover_path'],
                    'publisher' => $data['publisher'],
                ]
            );
        }
    }
}
