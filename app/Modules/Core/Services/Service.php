<?php

namespace App\Modules\Core\Services;

use App\Models\Lesson;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use App\Modules\Core\Helper\LanguageHelper;

abstract class Service
{
    protected $model;
    protected array $fields;
    protected string $searchField;
    protected MessageBag $errors;
    protected array $rules;
    protected bool $isTranslatable = false;

    public function __construct($model)
    {
        $this->model = $model;
        $this->errors = new MessageBag();
    }

    protected function getRelationFields(){
        return [];
    }

    public function find($id, $getAllTranslations = false)
    {
        return $this->getModel($getAllTranslations)->find($id);
    }

    public function create($data, $ruleKey = "add")
    {
        if(!$this->validate($data, $ruleKey)){
            return null;
        }
        if ($this->isTranslatable()) {
            $translationData = $data['translations'];
            unset($data['translations']);

            $model = $this->model->create($data);
            foreach ($translationData as $lang => $translation) {
                $translation['language_code'] = $lang;
                $model->translations()->create($translation);
            }

            return $model->load('translations');
        }

        return $this->model->create($data);
    }

    public function all($getAllTranslations, $search = ''){

        return $this->getModel($getAllTranslations)->get();
    }
    public function allPaginated($getAllTranslations, $perPage = 5, $search = ''){

        return $this->getModel($getAllTranslations)->paginate($perPage);
    }
    public function update($data, $id)
    {
        $data['id'] = $id;
        if(!$this->validate($data, 'update')){
            return null;
        }

        $model = $this->model->find($id);

        if (!$model) {
            return null;
        }

        if (!$this->validate($data, 'update')) {
            return null;
        }

        // If the service is translatable, handle the translations separately
        if ($this->isTranslatable()) {
            $translationData = $data['translations'];
            unset($data['translations']);

            $model->update($data);
            foreach ($translationData as $lang => $translation) {
                $translationModel = $model->translations()->where('language_code', $lang)->first();
                if ($translationModel) {
                    $translationModel->update($translation);
                } else {
                    $translation['language_code'] = $lang;
                    $model->translations()->create($translation);
                }
            }
            return $this->getModel(true)->find($id);
        }

        // Update the model instance
        $model->update($data);
        return $this->getModel(true)->find($id);
    }

    public function delete($id)
    {
        $model = $this->getModel()->find($id);

        if (!$model) {
            return null;
        }

        if ($this->isTranslatable()) {
            $model->translations()->delete();
        }

        $model->delete();

        return $model;
    }


    public function validate($data, $ruleKey)
    {

        $rules = $this->getRules($ruleKey);

        if ($this->isTranslatable()) {
            $rules['translations'] = function ($attribute, $value, $fail) {
                $requiredLanguages = LanguageHelper::getSupportedLanguages();
                $missingLanguages = array_diff($requiredLanguages, array_keys($value));
                if (!empty($missingLanguages)) {
                    $fail('Missing translations for: ' . implode(', ', $missingLanguages));
                }
            };
        }

        $this->errors = new MessageBag();
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            $this->errors = $validator->errors();
            return false;
        }

        return true;
    }

    private function getRules($ruleKey){
        $rules = $this->rules;
        if(isset($this->rules[$ruleKey])){
            $rules = $this->rules[$ruleKey];
        }

        return $rules;
    }

    public function getErrors(){
        return $this->errors;
    }

    public function hasErrors(){
        return $this->errors->isNotEmpty();
    }

    public function isTranslatable(): bool
    {
        return $this->isTranslatable;
    }
    public function getModel($all = false)
    {
        $language = App::getLocale();
        if ($all) {
            $language = null;
        }
        $model = $this->model
            ->with($this->getRelationFields());
        if ($this->isTranslatable() && $language !== null) {
            $model = $model->with(['translations' => function ($query) use ($language) {
                $query->where('language_code', $language);
            }]);
        }else if($this->isTranslatable()){
            $model = $model->with('translations');
        }

        return $model;
    }


}
