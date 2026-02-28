<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    use HasFactory;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([
        UserSeeder::class,
       ]);

       User::factory(10)->create

    }
}
