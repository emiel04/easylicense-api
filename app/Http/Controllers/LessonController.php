<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index()
    {
        return Lesson::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([

        ]);

        return Lesson::create($data);
    }

    public function show(Lesson $lesson)
    {
        return $lesson;
    }

    public function update(Request $request, Lesson $lesson)
    {
        $data = $request->validate([

        ]);

        $lesson->update($data);

        return $lesson;
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return response()->json();
    }
}
