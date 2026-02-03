<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TrainingClass extends Model
{
    protected $fillable = ['name','promotion'];


    // relations

    public function trainers(){
        return $this->belongsToMany(Trainer::class,'trainer_class')
        ->withPivot('trainer_type');
    }
    public function learners(){
        return $this->hasMany(Learner::class);
    }

    public function sprints() {
        return $this->hasMany(Sprint::class);
    }
}
