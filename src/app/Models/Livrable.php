<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livrable extends Model
{
    protected $fillable = ['url','brief_id','learner_id'];

    // relations

    public function learner(){
        return $this->belongsTo(Learner::class);
    }

    public function brief(){
        return $this->belongsTo(Brief::class);
    }
}
