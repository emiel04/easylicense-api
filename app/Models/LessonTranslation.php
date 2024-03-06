<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonTranslation extends Model
{
    protected function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    protected function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
