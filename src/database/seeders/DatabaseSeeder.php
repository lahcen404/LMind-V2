<?php

namespace Database\Seeders;

use App\Enums\TrainerType;
use App\Enums\UserRole;
use App\Models\Learner;
use App\Models\Trainer;
use App\Models\TrainingClass;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
   public function run(): void
    {
        // run Skill Seeder first
        $this->call(SkillSeeder::class);

        User::create([
            'full_name' => 'Lahcen Ait Maskour',
            'email' => 'lahcen.maskour2003@lmind.com',
            'password' => bcrypt('lahcen123'),
            'role' => UserRole::ADMIN,
        ]);

        // create trainers
        $u1 = User::create(['full_name' => 'Lahcen Main', 'email' => 'lahcen.maskour@gmail.com', 'password' => bcrypt('lahcen123'), 'role' => UserRole::TRAINER]);
        $u2 = User::create(['full_name' => 'Lahcen Backup', 'email' => 'lahcen.maskour@lmind.com', 'password' => bcrypt('lahcen123'), 'role' => UserRole::TRAINER]);

        $t1 = Trainer::create(['user_id' => $u1->id]);
        $t2 = Trainer::create(['user_id' => $u2->id]);

        // create a Class and link with traineers
        $class = TrainingClass::create(['name' => 'Debuggers', 'promotion' => 'P2026']);
        
        // pivoot trainer class
        $class->trainers()->attach($t1->id, ['trainer_type' => TrainerType::MAIN]);
        $class->trainers()->attach($t2->id, ['trainer_type' => TrainerType::BACKUP]);

        // create 20 random studeents in this class
        User::factory(20)->create(['role' => UserRole::LEARNER])->each(function ($user) use ($class) {
            Learner::create([
                'user_id' => $user->id,
                'training_class_id' => $class->id
            ]);
        });
    }
}
