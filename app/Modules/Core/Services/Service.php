<?php

namespace App\Modules\Core\Services;

use App\Models\Lesson;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

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

    public function find($id)
    {
        return $this->model
            ->select($this->fields)
            ->with($this->getRelationFields())
            ->find($id);
    }

    public function create($data, $ruleKey = "add")
    {
        if(! $this->validate($data, $ruleKey)){
            return null;
        }

        $quote = $this->model->create($data);
        return $quote;
    }

    public function all($language, $search = ''){

        return $this->getModel($language)->get();
    }
    public function allPaginated($language, $perPage = 5, $search = ''){

        return $this->getModel($language)->paginate($perPage);
    }
    public function update($data, $id)
    {
        throw new \Exception('Not implemented');
    }

    public function delete($id)
    {
        throw new \Exception('Not implemented');
    }

    public function validate($data, $ruleKey)
    {
        $rules = $this->getRules($ruleKey);

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
    public function getModel($language = null)
    {
        $model = $this->model
            ->with($this->getRelationFields());
        \Log::info($language);
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
