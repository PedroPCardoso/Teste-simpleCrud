<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LivroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titulo' => $this->faker->name(),
            'codigo' => Str::random(10),
            'autor' => $this->faker->name(),
            'edicao' => Str::random(10),
            'resumo' => Str::random(10)
            
        ];
    }
}
