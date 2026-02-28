<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();

        $user->name = 'administrador';
        $user->surname = 'administrador';
        $user->documentNumber = 1234567890;
        $user->phoneNumber = 3117110329;
        $user->email = 'admin@correo.com';
        $user->address = 'carrera 10 #21-49';
        $user->password = bcrypt('admin1234');
        $user->userType = 'admin';

        $user->save();

        $user = new User();

        $user->name = 'bibliotecario';
        $user->surname = 'bibliotecario';
        $user->documentNumber = 24681012;
        $user->phoneNumber = 3207996620;
        $user->email = 'biblio@correo.com';
        $user->address = 'carrera 10 #21-49';
        $user->password = bcrypt('admin1234');
        $user->userType = 'admin';

        $user->save();

    }
}
