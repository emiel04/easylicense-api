<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Modules\Lessons\LessonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LessonController extends ApiServiceController
{
    public function __construct(LessonService $service)
    {
        $this->service = $service;
    }
    public function all(Request $request)
    {
        $locale = App::getLocale();
        $lang = $request->input('lang', $locale);
        if($lang != $locale){
            App::setLocale($lang);
        }
        $lessons = $this->service->all($lang);
        return response()->json($lessons);
    }
    public function allTitles(Request $request)
    {
        $lessons = $this->service->titles();
        return response()->json($lessons);
    }
    public function random(Request $request)
    {
        $lesson = $this->service->random();
        return response()->json($lesson);
    }

}
