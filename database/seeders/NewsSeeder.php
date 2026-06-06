<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\News;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newsItems = [
            [
                'title' => 'Inauguración de la nueva sección de tecnología',
                'description' => 'Hemos añadido más de 50 libros nuevos sobre programación web, inteligencia artificial y bases de datos.',
                'image_url' => 'https://picsum.photos/800/600?random=1',
                'category' => 'Eventos',
                'tags' => 'tecnologia,libros,sistemas',
            ],
            [
                'title' => 'Mantenimiento programado de la plataforma',
                'description' => 'El sistema de préstamos estará fuera de servicio este domingo de 2:00 AM a 6:00 AM por actualización de servidores.',
                'image_url' => null,
                'category' => 'Avisos',
                'tags' => 'mantenimiento,plataforma',
            ],
            [
                'title' => 'Club de lectura: "Ficciones" de Jorge Luis Borges',
                'description' => 'Acompáñanos este viernes a las 4:00 PM en la sala principal para debatir sobre esta obra maestra.',
                'image_url' => 'https://picsum.photos/800/600?random=2',
                'category' => 'Talleres',
                'tags' => 'literatura,borges,debate',
            ],
            [
                'title' => 'Nuevos horarios de atención para el fin de semana',
                'description' => 'A partir del próximo mes, la biblioteca abrirá los sábados hasta las 8:00 PM.',
                'image_url' => null,
                'category' => 'Avisos',
                'tags' => 'horarios,comunidad',
            ],
            [
                'title' => 'Taller de Introducción a Linux y Entornos de Escritorio',
                'description' => 'Aprende a instalar y personalizar distribuciones como Ubuntu, Debian y MX Linux desde cero.',
                'image_url' => 'https://picsum.photos/800/600?random=3',
                'category' => 'Talleres',
                'tags' => 'linux,open-source,educacion',
            ],
            [
                'title' => 'Donación masiva de novelas gráficas',
                'description' => 'Agradecemos a la fundación cultural por la entrega de más de 100 cómics y mangas clásicos.',
                'image_url' => 'https://picsum.photos/800/600?random=4',
                'category' => 'Donaciones',
                'tags' => 'comics,manga,arte',
            ],
            [
                'title' => 'Ganadores del concurso de cuento corto 2026',
                'description' => 'Felicitamos a los tres estudiantes locales que ocuparon el podio en esta edición literaria.',
                'image_url' => 'https://picsum.photos/800/600?random=5',
                'category' => 'Cultura',
                'tags' => 'concurso,escritura,talento',
            ],
            [
                'title' => 'Semana de la Ciencia: Charlas de Astronomía',
                'description' => 'Inscripciones abiertas para los paneles de observación estelar dirigidos a jóvenes.',
                'image_url' => 'https://picsum.photos/800/600?random=6',
                'category' => 'Eventos',
                'tags' => 'ciencia,astronomia,charla',
            ],
            [
                'title' => 'Recomendado del mes: Gestión de Proyectos con Scrum',
                'description' => 'Una guía práctica para dominar marcos de trabajo ágiles en entornos de desarrollo de software.',
                'image_url' => 'https://picsum.photos/800/600?random=7',
                'category' => 'Recomendaciones',
                'tags' => 'scrum,gestion,libros',
            ],
            [
                'title' => 'Actualización del reglamento interno de préstamos',
                'description' => 'Se han modificado los días de prórroga para los usuarios con rol de lector activo.',
                'image_url' => null,
                'category' => 'Avisos',
                'tags' => 'reglamento,prestamos',
            ],
            [
                'title' => 'Exposición fotográfica: Paisajes y Atardeceres',
                'description' => 'Una galería interactiva capturada por fotógrafos aficionados de nuestra región.',
                'image_url' => 'https://picsum.photos/800/600?random=8',
                'category' => 'Cultura',
                'tags' => 'fotografia,arte,exposicion',
            ],
            [
                'title' => 'Llegaron los nuevos títulos de Laravel y PHP 8.x',
                'description' => 'Domina el desarrollo de APIs robustas y la arquitectura MVC con las últimas adquisiciones de la sección técnica.',
                'image_url' => 'https://picsum.photos/800/600?random=9',
                'category' => 'Eventos',
                'tags' => 'php,laravel,backend',
            ],
            [
                'title' => 'Cine foro los jueves por la tarde',
                'description' => 'Este mes proyectaremos un ciclo de cine clásico de ciencia ficción. Entrada libre.',
                'image_url' => 'https://picsum.photos/800/600?random=10',
                'category' => 'Cultura',
                'tags' => 'cine,entretenimiento,foro',
            ],
            [
                'title' => 'Tutorial: ¿Cómo usar el catálogo digital?',
                'description' => 'Hemos publicado un video tutorial paso a paso para que reserves tus libros desde casa.',
                'image_url' => null,
                'category' => 'Talleres',
                'tags' => 'tutorial,catalogo,digital',
            ],
            [
                'title' => 'Encuentro de poesía colombiana contemporánea',
                'description' => 'Un espacio para escuchar y compartir versos de autores locales destacados.',
                'image_url' => 'https://picsum.photos/800/600?random=11',
                'category' => 'Cultura',
                'tags' => 'poesia,literatura,autores',
            ],
            [
                'title' => 'Convocatoria abierta para voluntarios',
                'description' => 'Si te apasiona la lectura, ayúdanos a organizar los inventarios y los eventos del próximo trimestre.',
                'image_url' => 'https://picsum.photos/800/600?random=12',
                'category' => 'Eventos',
                'tags' => 'voluntariado,comunidad',
            ],
            [
                'title' => 'Cierre de fin de año por festividades',
                'description' => 'Informamos que las instalaciones físicas permanecerán cerradas los días de fiesta nacional.',
                'image_url' => null,
                'category' => 'Avisos',
                'tags' => 'horarios,festivos',
            ],
            [
                'title' => 'Colección especial de música y partituras',
                'description' => 'Ya están disponibles para consulta las partituras físicas de música folclórica y tradicional.',
                'image_url' => 'https://picsum.photos/800/600?random=13',
                'category' => 'Recomendaciones',
                'tags' => 'musica,arte,partituras',
            ],
            [
                'title' => 'Charla sobre Sostenibilidad Tecnológica',
                'description' => 'Aprende estrategias efectivas para reciclar hardware y reducir el impacto ambiental.',
                'image_url' => 'https://picsum.photos/800/600?random=14',
                'category' => 'Talleres',
                'tags' => 'sostenibilidad,hardware,ecologia',
            ],
            [
                'title' => 'Celebración del Día Internacional del Libro',
                'description' => 'Tendremos descuentos en cafeterías aliadas y actividades de intercambio de libros en el parque central.',
                'image_url' => 'https://picsum.photos/800/600?random=15',
                'category' => 'Eventos',
                'tags' => 'dia-del-libro,cultura,intercambio',
            ],
        ];

        foreach ($newsItems as $data) {
             News::firstOrCreate(
                ['title' => $data['title']],
                [
                    'description' => $data['description'],
                    'image_url'   => $data['image_url'],
                    'category'    => $data['category'],
                    'tags'        => $data['tags']
                ]
            );
        }
    }
}
