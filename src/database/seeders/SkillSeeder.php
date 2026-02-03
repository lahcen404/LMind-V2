<?php

namespace Database\Seeders;

use App\Enums\SkillCategory;
use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            ['code' => 'C1', 'name' => 'Maquetter une application', 'category' => SkillCategory::FRONTEND],
            ['code' => 'C2', 'name' => 'Réaliser une interface utilisateur', 'category' => SkillCategory::FRONTEND],
            ['code' => 'C3', 'name' => 'Développer une base de données', 'category' => SkillCategory::BACKEND],
            ['code' => 'C4', 'name' => 'Développer des composants backend', 'category' => SkillCategory::BACKEND],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}
