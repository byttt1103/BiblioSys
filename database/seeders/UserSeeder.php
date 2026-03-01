<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User;

        $user->first_name = 'administrador';
        $user->last_name = 'administrador';
        $user->document_number = 1234567890;
        $user->phone_number = 3117110329;
        $user->email = 'admin@correo.com';
        $user->address = 'carrera 10 #21-49';
        $user->password = bcrypt('admin1234');
        $user->user_type = 'admin';

        $user->save();

        $user = new User;

        $user->first_name = 'bibliotecario';
        $user->last_name = 'bibliotecario';
        $user->document_number = 24681012;
        $user->phone_number = 3207996620;
        $user->email = 'biblio@correo.com';
        $user->address = 'carrera 10 #21-49';
        $user->password = bcrypt('admin1234');
        $user->user_type = 'admin';

        $user->save();

    }
}
