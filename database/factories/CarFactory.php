<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
            return [
                'marque' => $this->faker->randomElement(['Toyota', 'Honda', 'Ford']),
                'modele' => $this->faker->randomElement(['Camry', 'Civic', 'Mustang']),
                'annee' => $this->faker->year,
                'prix' => $this->faker->numberBetween(10000, 50000),
            ];
            }
}
