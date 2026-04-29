<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LibraryInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('library')->insert([
            'id' => '01766a9c-29d4-4ac9-abaa-98f324665827',
            'name' => 'Biblioteca Central ',
            'owner' => 1,
            'address' => 'Calle Principal 123, Ciudad',
            'phone_number' => '1234567890',
            'email' => 'biblioteca@central.com',
            'description' => 'Biblioteca Central  de la Ciudad. Aquí podrás pasar ratos agradables con tus compañeeros, leyendo un libro, disfrutando de los talleres semanales, o simplemente relajándote en un ambiente tranquilo.
            Tenemos un nuevo servicio de préstamo de libros totalmente automatizado, para que puedas llevártelos a casa con total tranquilidad.
            Además contamos con servicio de computadores e Internet Wi-Fi de alta velocidad, para que puedas estudiar o trabajar sin interrupciones. ¡Te esperamos en la Biblioteca Central de la Ciudad, tu espacio de conocimiento y cultura!',
            'opening_hour_weekday' => '08:00:00',
            'closing_hour_weekday' => '20:00:00',
            'opening_hour_weekend' => '09:00:00',
            'closing_hour_weekend' => '18:00:00'
        ]);
    }
}
