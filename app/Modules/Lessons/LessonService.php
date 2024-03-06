<?php

namespace App\Modules\Lessons;

use App\Models\Lesson;
use App\Modules\Core\Services\Service;

class LessonService extends Service
{
    protected array $fields = ['id', 'category_id'];
    protected string $searchField = 'id';
    protected bool $isTranslatable = true;
    protected array $rules = [
        "add" => [
            'category_id' => 'required|exists:categories,id',
        ],
        "update" => [
            'category_id' => 'required|exists:categories,id',
        ]
    ];

    protected function getRelationFields(): array
    {
        return [
            'category:id,name',
        ];
    }

    public function __construct(Lesson $model)
    {
        parent::__construct($model);
    }

    public function random()
    {
        return $this->model
            ->select($this->fields)
            ->with($this->getRelationFields())
            ->with('translations')
            ->inRandomOrder()
            ->first();
    }

    public function all($perPage, $search)
    {
        return $this->model
            ->paginate($perPage);
    }
}
