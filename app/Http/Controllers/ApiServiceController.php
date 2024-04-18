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
        $lang = $request->input('lang');
        if($lang != $locale){
            App::setLocale($lang);
        }
        $all = $this->service->all($lang)->toArray();

        $result = [];

        if (isset($all[0]["translations"])) {
            foreach ($all as $index => $item) {
                if (isset($item["translations"])) {
                    if (count($item["translations"]) == 1) {
                        $result[$index] = $item;
                        foreach ($item["translations"][0] as $key => $value) {
                            $result[$index][$key] = $value;
                            unset($result[$index]['translations']);
                        }
                    }else{
                        $result = $all;
                        break;
                    }
                }
            }
        }else{
            $result = $all;
        }

        return response()->json($result);
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
