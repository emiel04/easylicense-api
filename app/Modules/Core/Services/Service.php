<?php

namespace App\Modules\Core\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

abstract class Service
{
    protected object $model;
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

    public function all($perPage, $search){
//        return $this->model
//            ->with($this->getRelationFields())
//            ->paginate($perPage);
        return $this->getModel()->get();
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

    public function isTranslatable()
    {
        return $this->isTranslatable;
    }

    protected function getModel(string $language='')
    {
        if($language){
            App::setLocale($language);
        }
        $model = $this->model
        ->select($this->fields);
//        ->with($this->getRelationFields());

        if($this->isTranslatable()){
            $model->with($this->getTranslations($language));
        }
        return $model;
    }

    protected function getTranslations(string $language): array
    {
        return [
            'translations' => function() use ($language) {
                return $this->model->translations().where('language_id', $language);
            }
        ];
    }
}
