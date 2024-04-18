<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonTranslation extends Model
{
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at', 'id', 'lesson_id'];
    protected $fillable = ['title', 'content', 'language_code'];
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

}
