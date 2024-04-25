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
            'category'
        ];
    }

    public function __construct(Lesson $model)
    {
        parent::__construct($model);
    }
    protected $model = Lesson::class;

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

    public function getModel($all = false)
    {
        $parentData = parent::getModel($all);

        if(!auth()->check()){
            return $parentData;
        }
//        \Log::info(json_encode($parentData->get()));
        // if the user is logged in, we will add if the user completed the lesson or not

        return $parentData
            ->leftJoin('user_lesson_progressions', function ($join) {
                $join->on('lessons.id', '=', 'user_lesson_progressions.lesson_id')
                    ->where('user_lesson_progressions.user_id', auth()->id());
            })                              // if no matching record, just put it to false
            ->select('lessons.*', \DB::raw('coalesce(user_lesson_progressions.completed, false) as completed'));

    }
}
