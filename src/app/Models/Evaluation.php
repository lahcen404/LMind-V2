<?php

namespace App\Models;

use App\Enums\MasteryLevel;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
   protected $fillable = [
        'comment', 
        'achieved_level', 
        'learner_id', 
        'brief_id', 
        'skill_id'
    ];

    protected function casts(){
        return [
            'achieved_level' => MasteryLevel::class, 
        ];
    }

    public function learner(){
        return $this->belongsTo(Learner::class);
    }

    public function brief() {
        return $this->belongsTo(Brief::class);
    }

    public function skill(){
        return $this->belongsTo(Skill::class);
    }
}
