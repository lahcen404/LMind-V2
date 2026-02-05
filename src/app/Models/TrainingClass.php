<?php

namespace App\Models;

use App\Enums\TrainerType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TrainingClass extends Model
{
    protected $fillable = ['name','promotion'];


    // relations

    // trainerrs
    public function trainers(): BelongsToMany
    {
        return $this->belongsToMany(Trainer::class, 'trainer_class', 'training_class_id', 'trainer_id')
                    ->withPivot('trainer_type')
                    ->withTimestamps();
    }

  // learners
    public function learners()
    {
        return $this->hasMany(Learner::class, 'training_class_id');
    }

    // spriints
    public function sprints()
    {
        return $this->hasMany(Sprint::class, 'training_class_id');
    }

    // get main trainner
    public function getMainTrainerAttribute()
    {
        $trainer = $this->trainers()
                        ->wherePivot('trainer_type', TrainerType::MAIN->value)
                        ->first();

        return $trainer ? $trainer->user : null;
    }
}
