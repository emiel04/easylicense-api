<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonTranslation extends Model
{
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at'];

    protected function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    protected function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

}
