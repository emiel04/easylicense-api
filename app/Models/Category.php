<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at'];

    protected function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }


}