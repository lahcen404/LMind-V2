<?php

namespace App\Models;

use App\Enums\BriefType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Brief extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'description',
        'duration',
        'type',
        'training_class_id',
        'trainer_id',
        'sprint_id',
    ];

    // casts type to enum
    protected $casts = [
        'type' => BriefType::class,
    ];

    //  class relation
    public function trainingClass(): BelongsTo
    {
        return $this->belongsTo(TrainingClass::class, 'training_class_id');
    }

    // trainer relation
    public function trainer(): BelongsTo
    {
        return $this->belongsTo(Trainer::class);
    }

   // sprint relation
    public function sprint(): BelongsTo
    {
        return $this->belongsTo(Sprint::class);
    }

    // skills relation
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'brief_skill')
            ->withPivot('expected_level')
            ->withTimestamps();
    }
}
