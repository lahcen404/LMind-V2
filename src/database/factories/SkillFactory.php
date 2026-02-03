<?php

namespace Database\Factories;

use App\Enums\SkillCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SkillFactory extends Factory
{
    protected static $order = 1;
   public function definition(): array
    {
        return [
            'code' => 'C' . self::$order++, 
            'name' => fake()->unique()->word() . ' Mastery',
            'category' => fake()->randomElement(SkillCategory::cases()),
        ];
    }
}
