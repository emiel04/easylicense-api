<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Modules\Lessons\LessonService;
use Illuminate\Http\Request;

class LessonController extends ApiServiceController
{
    public function __construct(LessonService $service)
    {
        $this->service = $service;
    }
    public function all(Request $request)
    {
        $lessons = $this->service->all(10, "");
        return response()->json($lessons);
    }


}
