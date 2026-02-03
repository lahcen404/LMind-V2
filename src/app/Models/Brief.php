<?php

namespace App\Models;

use App\Enums\BriefType;
use Illuminate\Database\Eloquent\Model;

class Brief extends Model
{
    
    protected $fillable = ['title', 'description', 'type', 'sprint_id'];

    protected function casts(): array {
        return ['type' => BriefType::class]; 
    }

    // relations
    public function skills() {
        return $this->belongsToMany(Skill::class, 'brief_skill')
            ->withPivot('expected_level'); 
    }

    public function sprint() {
        return $this->belongsTo(Sprint::class);
    }

    public function livrables() {
        return $this->hasMany(Livrable::class);
    }
}
