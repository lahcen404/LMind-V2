<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    protected $fillable = ['name','duration','order_sprint','training_class_id'];

    // relations 
    public function trainingClass(){
        return $this->belongsTo(TrainingClass::class);
    }

    public function briefs(){
        return $this->hasMany(Brief::class);
    }
}
