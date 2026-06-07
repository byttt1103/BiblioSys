<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            ['name' => 'Otros Autores', 'biography' => 'Una selección de autores destacados de la literatura mundial.'],
            ['name' => 'Gabriel García Márquez', 'biography' => 'Escritor y periodista colombiano, premio Nobel de Literatura 1982. Máximo representante del realismo mágico.'],
            ['name' => 'Miguel de Cervantes', 'biography' => 'Novelista, poeta y dramaturgo español. Autor de El ingenioso hidalgo don Quijote de la Mancha.'],
            ['name' => 'Julio Cortázar', 'biography' => 'Escritor e intelectual argentino. Una de las grandes figuras del boom latinoamericano.'],
            ['name' => 'Juan Rulfo', 'biography' => 'Escritor mexicano. Autor de Pedro Páramo y El llano en llamas.'],
            ['name' => 'Isabel Allende', 'biography' => 'Escritora chilena. Autora de La casa de los espíritus y numerosas novelas traducidas a muchos idiomas.'],
            ['name' => 'Ernesto Sabato', 'biography' => 'Escritor y físico argentino. Autor de El túnel, Sobre héroes y tumbas y Abaddón el exterminador.'],
            ['name' => 'Jorge Luis Borges', 'biography' => 'Escritor argentino, uno de los autores más influyentes del siglo XX. Poeta, cuentista y ensayista.'],
            ['name' => 'Laura Esquivel', 'biography' => 'Escritora mexicana. Autora de Como agua para chocolate, llevada al cine.'],
            ['name' => 'Octavio Paz', 'biography' => 'Poeta y ensayista mexicano, premio Nobel de Literatura 1990.'],
            ['name' => 'Mario Vargas Llosa', 'biography' => 'Escritor peruano, premio Nobel de Literatura 2010. Novelista, ensayista y político.'],
            ['name' => 'Roberto Bolaño', 'biography' => 'Escritor y poeta chileno. Autor de Los detectives salvajes y 2666.'],
            ['name' => 'José Donoso', 'biography' => 'Escritor chileno. Figura del boom latinoamericano. Autor de El obsceno pájaro de la noche.'],
            ['name' => 'Mario Benedetti', 'biography' => 'Escritor y poeta uruguayo. Autor de La tregua, Gracias por el fuego y Poemas de la oficina.'],
            ['name' => 'Umberto Eco', 'biography' => 'Semiólogo, filósofo y escritor italiano. Autor de El nombre de la rosa y ensayos sobre literatura.'],
        ];

        foreach ($authors as $data) {
            Author::firstOrCreate(
                ['name' => $data['name']],
                [
                    'biography' => $data['biography'],
                ]
            );
        }
    }
}
