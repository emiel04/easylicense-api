<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    use HasFactory;
    protected $model = Lesson::class;
    protected function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function translations()
    {
        return $this->hasMany(LessonTranslation::class);
    }
}
