<?php

namespace App\Models;

use App\Enums\SkillCategory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['code','name','category'];

    public function casts(){
        return ['category'=> SkillCategory::class,];
    }

    // relations 

    public function evaluations(){
        return $this->hasMany(Evaluation::class);
    }

    public function skills() {
        return $this->belongsToMany(Brief::class, 'brief_skill')
            ->withPivot('expected_level')
            ->withTimestamps(); 
    }
}
