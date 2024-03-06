<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryTranslation extends Model
{
    protected function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
