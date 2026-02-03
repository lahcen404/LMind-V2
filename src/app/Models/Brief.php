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

    public function skills() {
        return $this->belongsToMany(Skill::class, 'brief_skill')
            ->withPivot('expected_level'); 
    }
}
