<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = ['user_id'];

    // relations
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function training_classes(){
        return $this->belongsToMany(TrainingClass::class,'trainer_class')
                    ->withPivot('trainer_type')
                    ->withTimestamps();
    }
}


