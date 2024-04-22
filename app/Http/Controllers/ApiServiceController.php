<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

abstract class ApiServiceController extends Controller
{
    protected $service;

    public function find(Request $request, $id)
    {
        $lang = $request->input('lang');

        $data = $this->service->find($lang, $id);

        return response()->json($data);
    }

    public function all(Request $request)
    {
        $lang = $request->input('lang');

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

    public function update(Request $request, $id)
    {
        $updatedData = $this->service->update($request->all(), $id);
        if ($this->service->hasErrors()) {
            $errors = $this->service->getErrors();
            $errors = $this->presentErrors($errors);
            return response()->json($errors, Response::HTTP_BAD_REQUEST);
        }

        return response()->json($updatedData, Response::HTTP_OK);
    }

    public function delete(Request $request, $id)
    {
        $deletedData = $this->service->delete($id);

        if (!$deletedData) {
            return response()->json(['message' => __('validation.record_not_found')], Response::HTTP_NOT_FOUND);
        }

        return response()->json($deletedData, Response::HTTP_OK);
    }
    private function presentErrors($errors){

        return
            [
                "success" => false,
                "errors" => $errors
            ];
    }

}
