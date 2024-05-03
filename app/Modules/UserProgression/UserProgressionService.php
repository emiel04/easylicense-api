<?php

namespace App\Modules\UserProgression;


use App\Http\Controllers\UserProgressionController;
use App\Models\UserLessonProgression;
use App\Modules\Core\Services\Service;

class UserProgressionService extends Service
{
    protected array $fields = ['user_id', 'lesson_id', 'completed'];
    protected array $rules =
        [
            'completed' => 'required|boolean',
            'user_id' => 'required|exists:users,id',
            'lesson_id' => 'required|exists:lessons,id',
        ];
    protected string $searchField = 'id';
    protected bool $isTranslatable = false;
    protected $model = UserLessonProgression::class;
    protected function getRelationFields(): array
    {
        return [
            'user:id,name' // only the id and name are needed
        ];
    }

    public function updateOrCreate($data) // TODO put this method in service and make sure it works with translatables
    {
        if (!$this->validate($data, 'updateOrCreate')) {
            return null;
        }

        return $this->model->updateOrCreate(
            [
                'user_id' => $data['user_id'],
                'lesson_id' => $data['lesson_id'],
            ],
            [
                'completed' => $data['completed'],
            ]
        );
    }

    public function __construct(UserLessonProgression $model)
    {
        parent::__construct($model);
    }
}
