<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLessonProgression extends Model
{
    protected function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}
