<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles=[
            ['name'=>'admin','description'=>'Administrador del sistema, tiene acceso a todas las funcionalidades.'],
            ['name'=>'librarian','description'=>'Bibliotecario, encargado de gestionar los libros, sus préstamos y otros usuarios, pero no puede modificar los roles ni los usarios de su mismo rol o superior.'],
            ['name'=>'reader','description'=>'Lector, puede buscar y solicitar préstamos de libros, y hacer modificaciones limitadas a los datos de su perfil.']
        ];

        foreach($roles as $role){
            Role::firstOrCreate(
                ['name'=>$role['name']],
                ['description'=>$role['description']]
            );
        }
    }

}
