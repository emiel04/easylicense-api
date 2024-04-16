<?php

namespace App\Modules\Categories;

use App\Models\Category;
use App\Models\Lesson;
use App\Modules\Core\Services\Service;

class CategoryService extends Service
{
    protected array $fields = ['id'];
    protected string $searchField = 'id';
    protected bool $isTranslatable = true;
    protected $model = Category::class;
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }
}
