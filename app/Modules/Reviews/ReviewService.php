<?php

namespace App\Modules\Reviews;

use App\Models\Category;
use App\Models\Lesson;
use App\Models\Review;
use App\Modules\Core\Services\Service;

class ReviewService extends Service
{
    protected array $fields = ['content', 'rating', 'grade', 'user_id'];
    protected array $rules =
        ['content' => 'required',
            'rating' => 'required|integer|min:0|max:5',
            'grade' => 'required|integer|min:1|max:50',
            'user_id' => 'required'];
    protected string $searchField = 'id';
    protected bool $isTranslatable = false;
    protected $model = Review::class;
    public function __construct(Review $model)
    {
        parent::__construct($model);
    }
}