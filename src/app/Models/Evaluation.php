<?php

namespace App\Models;

use App\Enums\MasteryLevel;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected function casts(): array{
        return [
            'achieved_level' => MasteryLevel::class,
        ];
    }
}
