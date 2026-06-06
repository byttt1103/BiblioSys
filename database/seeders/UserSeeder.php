<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['first_name' => 'administrador', 'last_name' => 'administrador', 'document_number' => 1234567890, 'phone_number' => 3117110329, 'email' => 'admin@correo.com', 'address' => 'carrera 10 #21-49', 'password' => bcrypt('admin1234'), 'user_type' => ['admin', 'librarian']],
            ['first_name' => 'bibliotecario', 'last_name' => 'bibliotecario', 'document_number' => 24681012, 'phone_number' => 3207996620, 'email' => 'biblio@correo.com', 'address' => 'carrera 10 #21-49', 'password' => bcrypt('biblio1234'), 'user_type' => ['librarian']],
            ['first_name' => 'lector', 'last_name' => 'lector', 'document_number' => 135791113, 'phone_number' => 3101234567, 'email' => 'lector@correo.com', 'address' => 'carrera 10 #21-49', 'password' => bcrypt('lector1234'), 'user_type' => ['reader']],
            ['first_name' => 'Carlos', 'last_name' => 'Mendoza', 'document_number' => 5544332211, 'phone_number' => 3124567890, 'email' => 'carlos.mendoza@correo.com', 'address' => 'calle 15 #10-20', 'password' => bcrypt('lector5544'), 'user_type' => ['reader']],
            ['first_name' => 'Ana', 'last_name' => 'Gómez', 'document_number' => 9988776655, 'phone_number' => 3159876543, 'email' => 'ana.gomez@correo.com', 'address' => 'avenida 4 #12-34', 'password' => bcrypt('lector9988'), 'user_type' => ['reader']],

        ];

        foreach ($users as $user) {
            $roles = $user['user_type'];
            unset($user['user_type']); // Remove user_type from the user data

            $createdUser = User::firstOrCreate(
                ['document_number' => $user['document_number']], // Unique identifier for the user
                $user
            );

            // Attach the appropriate role to the user
           $assignedRole = Role::whereIn('name', $roles)->pluck('id');
           $createdUser->roles()->sync($assignedRole);

        }
    }


}
