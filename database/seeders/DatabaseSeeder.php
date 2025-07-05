<?php

namespace Database\Seeders;

// use App\Models\User;
use App\Models\Animal;
use App\Models\TypeAnimal;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        TypeAnimal::factory(5)->create();
        Animal::factory(1000)->create();
    }
}
