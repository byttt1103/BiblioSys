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
            ['name' => 'Gabriel García Márquez', 'avatar_path' => 'avatars/garcia-marquez.jpg', 'biography' => 'Escritor y periodista colombiano, premio Nobel de Literatura 1982. Máximo representante del realismo mágico.'],
            ['name' => 'Miguel de Cervantes', 'avatar_path' => 'avatars/cervantes.jpg', 'biography' => 'Novelista, poeta y dramaturgo español. Autor de El ingenioso hidalgo don Quijote de la Mancha.'],
            ['name' => 'Julio Cortázar', 'avatar_path' => 'avatars/cortazar.jpg', 'biography' => 'Escritor e intelectual argentino. Una de las grandes figuras del boom latinoamericano.'],
            ['name' => 'Juan Rulfo', 'avatar_path' => 'avatars/rulfo.jpg', 'biography' => 'Escritor mexicano. Autor de Pedro Páramo y El llano en llamas.'],
            ['name' => 'Isabel Allende', 'avatar_path' => 'avatars/allende.jpg', 'biography' => 'Escritora chilena. Autora de La casa de los espíritus y numerosas novelas traducidas a muchos idiomas.'],
            ['name' => 'Ernesto Sabato', 'avatar_path' => 'avatars/sabato.jpg', 'biography' => 'Escritor y físico argentino. Autor de El túnel, Sobre héroes y tumbas y Abaddón el exterminador.'],
            ['name' => 'Jorge Luis Borges', 'avatar_path' => 'avatars/borges.jpg', 'biography' => 'Escritor argentino, uno de los autores más influyentes del siglo XX. Poeta, cuentista y ensayista.'],
            ['name' => 'Laura Esquivel', 'avatar_path' => 'avatars/esquivel.jpg', 'biography' => 'Escritora mexicana. Autora de Como agua para chocolate, llevada al cine.'],
            ['name' => 'Octavio Paz', 'avatar_path' => 'avatars/paz.jpg', 'biography' => 'Poeta y ensayista mexicano, premio Nobel de Literatura 1990.'],
            ['name' => 'Mario Vargas Llosa', 'avatar_path' => 'avatars/vargas-llosa.jpg', 'biography' => 'Escritor peruano, premio Nobel de Literatura 2010. Novelista, ensayista y político.'],
            ['name' => 'Roberto Bolaño', 'avatar_path' => 'avatars/bolano.jpg', 'biography' => 'Escritor y poeta chileno. Autor de Los detectives salvajes y 2666.'],
            ['name' => 'José Donoso', 'avatar_path' => 'avatars/donoso.jpg', 'biography' => 'Escritor chileno. Figura del boom latinoamericano. Autor de El obsceno pájaro de la noche.'],
            ['name' => 'Mario Benedetti', 'avatar_path' => 'avatars/benedetti.jpg', 'biography' => 'Escritor y poeta uruguayo. Autor de La tregua, Gracias por el fuego y Poemas de la oficina.'],
            ['name' => 'Umberto Eco', 'avatar_path' => 'avatars/eco.jpg', 'biography' => 'Semiólogo, filósofo y escritor italiano. Autor de El nombre de la rosa y ensayos sobre literatura.'],
        ];

        foreach ($authors as $data) {
            Author::firstOrCreate(
                ['name' => $data['name']],
                [
                    'avatar_path' => $data['avatar_path'],
                    'biography' => $data['biography'],
                ]
            );
        }
    }
}
