<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Modules\UserProgression\UserProgressionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;

class UserProgressionController extends ApiServiceController
{
    public function __construct(UserProgressionService $service)
    {
        $this->service = $service;
    }

    public function updateOrCreate(Request $request, $lesson_id) // TODO put this method in abstract controller and make sure it works with translatables
    {
        $data = $request->all();
        $data['user_id'] = $request->user()->id;
        $data['lesson_id'] = $lesson_id;
        $progress = $this->service->updateOrCreate($data);

        if ($this->service->hasErrors()) {
            $errors = $this->service->getErrors();
            $errors = $this->presentErrors($errors);
            return response()->json($errors, Response::HTTP_BAD_REQUEST);
        }

        $status_code = $progress->wasRecentlyCreated ? Response::HTTP_CREATED : Response::HTTP_OK;

        return response()->json($progress, $status_code);
    }

}
