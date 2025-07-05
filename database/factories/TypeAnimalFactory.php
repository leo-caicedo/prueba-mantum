<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TypeAnimalFactory extends Factory
{
    protected static array $typesAnimal = [
        'mamifero',
        'ave',
        'pez',
        'reptil',
        'insecto'
    ];

    public function definition(): array
    {
        return [
            'name' => fake()
              ->unique()
              ->randomElement(static::$typesAnimal)
        ];
    }
}
