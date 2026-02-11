<?php

namespace Database\Factories;

use App\Enums\MasteryLevel;
use App\Models\Brief;
use App\Models\Learner;
use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evaluation>
 */
class EvaluationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment' => fake()->sentence(),
            'achieved_level' => fake()->randomElement(MasteryLevel::cases()),
            'learner_id' => Learner::factory(),
            'brief_id' => Brief::factory(),
            'skill_id' => Skill::factory(),
        ];
    }
}
