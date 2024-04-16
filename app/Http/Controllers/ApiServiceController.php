<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

abstract class ApiServiceController extends Controller
{
    protected $service;

    public function find($id)
    {
        $quote = $this->service->find($id);

        return response()->json($quote);
    }

    public function all(Request $request)
    {
        $locale = App::getLocale();
        $lang = $request->input('lang', $locale);
        if($lang != $locale){
            App::setLocale($lang);
        }
        $all = $this->service->all($lang);

        return response()->json($all);
    }


    public function create(Request $request)
    {
        $quote = $this->service->create($request->all());
        if ($this->service->hasErrors()) {
            $errors = $this->service->getErrors();
            $errors = $this->presentErrors($errors);
            return response()->json($errors, Response::HTTP_BAD_REQUEST);
        }

        return response()->json($quote, Response::HTTP_CREATED);
    }

    public  function update(Request $request, $id)
    {
        throw new \Exception('Not implemented');
    }

    public function delete($id)
    {
        throw new \Exception('Not implemented');
    }

    private function presentErrors($errors){

        return
            [
                "success" => false,
                "errors" => $errors
            ];
    }

}
