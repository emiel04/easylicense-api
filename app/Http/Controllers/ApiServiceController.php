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

        $data = $this->service->find($lang, $id)->toArray(); // transform the data to an associative array so that it can be manipulated
        if (empty($data)) {
            return response(null, Response::HTTP_NOT_FOUND);
        }

        return response()->json($this->transformTranslatableData($data));
    }

    public function allPaginated(Request $request)
    {
        return $this->all($request, true);
    }

    public function all(Request $request, $paginated = false)
    {
        $lang = $request->input('lang');

        if ($paginated) {
            $all = $this->service->allPaginated($lang)->toArray(); // transform the data to an associative array so that it can be manipulated
        } else {
            $all = $this->service->all($lang)->toArray();
        }

        foreach ($all as &$item) { // & means that we are passing the reference of the item
            $item = $this->transformTranslatableData($item);
        }

        return response()->json($all);
    }


    private function transformTranslatableData($data)
    {
        if (isset($data["translations"]) && count($data["translations"]) == 1) {
            $translatedData = $data["translations"][0];
            unset($data["translations"]);
            return array_merge($data, $translatedData);
        }

        return $data;
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
