<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Learner extends Model
{
    protected $fillable = [
        'user_id',
        'training_class_id'
    ];

    // relations 
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function training_class(){
        return $this->belongsTo(TrainingClass::class);
    }
}
