<?php

namespace Database\Seeders;

use App\Models\Author;
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
            ['title' => 'Cien años de soledad', 'cover_path' => 'covers/cien-anos.jpg', 'publisher' => 'Editorial Sudamericana', 'publication_year' => 1967, 'synopsis' => 'La historia de la familia Buendía a lo largo de siete generaciones en el pueblo imaginario de Macondo. Una saga que mezcla realidad y fantasía, amor y guerra, fundación y decadencia.', 'authors' => ['Gabriel García Márquez']],
            ['title' => 'Don Quijote de la Mancha', 'cover_path' => 'covers/quijote.jpg', 'publisher' => 'Francisco de Robles', 'publication_year' => 1605, 'synopsis' => 'Alonso Quijano, enloquecido por la lectura de libros de caballerías, se hace llamar Don Quijote y sale con su escudero Sancho Panza a vivir aventuras, confundiendo molinos con gigantes y posadas con castillos.', 'authors' => ['Miguel de Cervantes']],
            ['title' => 'El amor en los tiempos del cólera', 'cover_path' => 'covers/amor-colera.jpg', 'publisher' => 'Editorial Oveja Negra', 'publication_year' => 1985, 'synopsis' => 'Florentino Ariza y Fermina Daza se enamoran en su juventud, pero ella se casa con otro. Durante más de cincuenta años Florentino espera para declararle de nuevo su amor.', 'authors' => ['Gabriel García Márquez']],
            ['title' => 'Rayuela', 'cover_path' => 'covers/rayuela.jpg', 'publisher' => 'Editorial Sudamericana', 'publication_year' => 1963, 'synopsis' => 'Horacio Oliveira busca a la Maga en París y después en Buenos Aires. Novela que puede leerse en el orden tradicional o siguiendo un tablero de direcciones, cuestionando la linealidad del relato.', 'authors' => ['Julio Cortázar']],
            ['title' => 'Pedro Páramo', 'cover_path' => 'covers/pedro-paramo.jpg', 'publisher' => 'Fondo de Cultura Económica', 'publication_year' => 1955, 'synopsis' => 'Juan Preciado llega a Comala siguiendo la promesa a su madre de reclamar lo suyo a su padre, Pedro Páramo. El pueblo está habitado por muertos que hablan; pasado y presente se confunden.', 'authors' => ['Juan Rulfo']],
            ['title' => 'La casa de los espíritus', 'cover_path' => 'covers/casa-espiritus.jpg', 'publisher' => 'Editorial Sudamericana', 'publication_year' => 1982, 'synopsis' => 'Crónica de la familia Trueba a través de cuatro generaciones en un país latinoamericano sin nombre, con amor, política, violencia y poderes sobrenaturales.', 'authors' => ['Isabel Allende']],
            ['title' => 'El túnel', 'cover_path' => 'covers/tunel.jpg', 'publisher' => 'Editorial Sur', 'publication_year' => 1948, 'synopsis' => 'Juan Pablo Castel, pintor obsesionado, mata a María Iribarne creyendo que lo ha traicionado. Relato en primera persona sobre la soledad, el arte y la posesión.', 'authors' => ['Ernesto Sabato']],
            ['title' => 'Ficciones', 'cover_path' => 'covers/ficciones.jpg', 'publisher' => 'Editorial Sur', 'publication_year' => 1944, 'synopsis' => 'Colección de cuentos que juegan con laberintos, bibliotecas infinitas, libros que contienen el universo y identidades duplicadas. La ficción como espejo de lo real.', 'authors' => ['Jorge Luis Borges']],
            ['title' => 'El aleph', 'cover_path' => 'covers/aleph.jpg', 'publisher' => 'Editorial Losada', 'publication_year' => 1949, 'synopsis' => 'En el cuento que da título al libro, un punto en el sótano permite ver todos los puntos del universo a la vez. Otros relatos exploran el tiempo, la memoria y lo infinito.', 'authors' => ['Jorge Luis Borges']],
            ['title' => 'Como agua para chocolate', 'cover_path' => 'covers/chocolate.jpg', 'publisher' => 'Editorial Planeta', 'publication_year' => 1989, 'synopsis' => 'Tita no puede casarse con Pedro porque debe cuidar a su madre. Él se casa con su hermana para estar cerca. Recetas y emociones se mezclan en una historia de amor y tradición.', 'authors' => ['Laura Esquivel']],
            ['title' => 'El laberinto de la soledad', 'cover_path' => 'covers/laberinto.jpg', 'publisher' => 'Fondo de Cultura Económica', 'publication_year' => 1950, 'synopsis' => 'Ensayo sobre la identidad mexicana: el pelado, la máscara, la fiesta, la muerte. Reflexión sobre la soledad del mexicano y su relación con la historia y el mundo.', 'authors' => ['Octavio Paz']],
            ['title' => 'La ciudad y los perros', 'cover_path' => 'covers/ciudad-perros.jpg', 'publisher' => 'Editorial Seix Barral', 'publication_year' => 1963, 'synopsis' => 'En un colegio militar de Lima, un grupo de cadetes vive la violencia, el machismo y la delación. Un robo desencadena una venganza que marcará a los personajes.', 'authors' => ['Mario Vargas Llosa']],
            ['title' => 'Conversación en La Catedral', 'cover_path' => 'covers/catedral.jpg', 'publisher' => 'Editorial Seix Barral', 'publication_year' => 1969, 'synopsis' => 'Santiago Zavala y Ambrosio se encuentran en un bar llamado La Catedral. Una larga conversación reconstruye la corrupción del régimen de Odría y las vidas que se cruzan.', 'authors' => ['Mario Vargas Llosa']],
            ['title' => 'El otoño del patriarca', 'cover_path' => 'covers/otono-patriarca.jpg', 'publisher' => 'Editorial Plaza & Janés', 'publication_year' => 1975, 'synopsis' => 'Un dictador sin nombre gobierna un país caribeño durante décadas. La novela explora el poder absoluto, la soledad del tirano y la degradación, en frases largas y oníricas.', 'authors' => ['Gabriel García Márquez']],
            ['title' => 'Crónica de una muerte anunciada', 'cover_path' => 'covers/cronica-muerte.jpg', 'publisher' => 'Editorial La Oveja Negra', 'publication_year' => 1981, 'synopsis' => 'Todo el pueblo sabe que los hermanos Vicario van a matar a Santiago Nasar para vengar el honor de su hermana. La crónica reconstruye por qué aun así la muerte ocurre.', 'authors' => ['Gabriel García Márquez']],
            ['title' => 'El general en su laberinto', 'cover_path' => 'covers/general-laberinto.jpg', 'publisher' => 'Editorial Oveja Negra', 'publication_year' => 1989, 'synopsis' => 'Último viaje de Simón Bolívar por el río Magdalena, enfermo y derrotado. La novela humaniza al héroe y muestra el ocaso de quien soñó una América unida.', 'authors' => ['Gabriel García Márquez']],
            ['title' => 'Sobre la literatura', 'cover_path' => 'covers/sobre-literatura.jpg', 'publisher' => 'Tusquets', 'publication_year' => 2004, 'synopsis' => 'Recopilación de conferencias y ensayos de Umberto Eco sobre la narrativa, los clásicos, la traducción y el placer de leer. Reflexiones de un novelista y semiólogo.', 'authors' => ['Umberto Eco']],
            ['title' => 'Los detectives salvajes', 'cover_path' => 'covers/detectives-salvajes.jpg', 'publisher' => 'Anagrama', 'publication_year' => 1998, 'synopsis' => 'Arturo Belano y Ulises Lima, poetas del movimiento real visceralista, buscan a la misteriosa poeta Cesárea Tinajero. La novela recorre décadas y voces en México y el mundo.', 'authors' => ['Roberto Bolaño']],
            ['title' => '2666', 'cover_path' => 'covers/2666.jpg', 'publisher' => 'Anagrama', 'publication_year' => 2004, 'synopsis' => 'Cinco partes entrelazadas: críticos que persiguen a un escritor alemán, un profesor en Santa Teresa, un periodista, los crímenes de mujeres en la ciudad, y el pasado del escritor. Una obra sobre el mal y la literatura.', 'authors' => ['Roberto Bolaño']],
            ['title' => 'El obsceno pájaro de la noche', 'cover_path' => 'covers/pajaro-noche.jpg', 'publisher' => 'Editorial Seix Barral', 'publication_year' => 1970, 'synopsis' => 'Humberto Peñalozo, ex secretario de un aristócrata, escribe en un asilo de ancianos. La identidad, el poder y la deformidad se mezclan en un relato alucinado y barroco.', 'authors' => ['José Donoso']],
            ['title' => 'La tregua', 'cover_path' => 'covers/tregua.jpg', 'publisher' => 'Editorial Alfa', 'publication_year' => 1960, 'synopsis' => 'Martín Santomé, viudo y cercano a la jubilación, lleva un diario. Un amor tardío con una compañera de trabajo le da una tregua a la rutina, hasta que la realidad lo alcanza.', 'authors' => ['Mario Benedetti']],
        ];

        foreach ($books as $data) {
            $authors = $data['authors'];
            unset($data['authors']);

            $book = Book::firstOrCreate(
                [
                    'title' => $data['title'],
                    'publication_year' => $data['publication_year'],
                ],
                [
                    'cover_path' => $data['cover_path'],
                    'publisher' => $data['publisher'],
                    'synopsis' => $data['synopsis'],
                ]
            );

            $authorIds = Author::whereIn('name', $authors)->pluck('id');
            $book->authors()->syncWithoutDetaching($authorIds);
        }
    }
}
