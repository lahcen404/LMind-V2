<?php

namespace Database\Factories;

use App\Models\TrainingClass;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sprint>
 */
class SprintFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
    {
        return [
            'name' => 'Sprint ' . fake()->numberBetween(1, 10),
            'duration' => fake()->numberBetween(1, 4), 
            'order_sprint' => fake()->unique()->numberBetween(1, 100),
            'training_class_id' => TrainingClass::factory(), 
        ];
    }
}
