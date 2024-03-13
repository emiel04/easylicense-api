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
            'category',
            'translations:title,content'
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
            ->inRandomOrder()->first();
    }
    public function titles()
    {
        return $this->model
            ->select('id', 'title')
            ->with($this->getRelationFields())
            ->with('translations');
    }
}
