<?php

namespace App\Modules\Reviews;

use App\Models\Review;
use App\Modules\Core\Services\Service;

class ReviewService extends Service
{
    protected array $fields = ['content', 'rating', 'grade', 'user_id'];
    protected array $filters = ['grade', 'rating'];
    protected array $rules =
        [
            'content' => 'nullable|min:1',
            'rating' => 'required|integer|min:1|max:5',
            'grade' => 'required|integer|min:0|max:50',
            'user_id' => 'required'];
    protected string $searchField = 'id';
    protected bool $isTranslatable = false;
    protected $model = Review::class;
    protected function getRelationFields(): array
    {
        return [
            'user:id,name' // only the id and name are needed
        ];
    }
    public function __construct(Review $model)
    {
        parent::__construct($model);
    }
}
