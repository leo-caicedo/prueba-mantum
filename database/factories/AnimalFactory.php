<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TypeAnimal;


class AnimalFactory extends Factory
{
  public function definition()
  {
    return [
      'name' => fake()->name(),
      'birthdate' => fake()->dateTimeBetween('2010-00-00', '2023-00-00'),
      'animal_type_id' => function () {
        return TypeAnimal::query()
            ->inRandomOrder()
            ->first()->id;
      },
    ];
  }
}