<?php

namespace App\Models;

use App\Enums\BriefType;
use Illuminate\Database\Eloquent\Model;

class Brief extends Model
{
    protected function casts(): array{
        return [
            'type' => BriefType::class,
        ];
    }
}
