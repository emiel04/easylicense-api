<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends ApiServiceController
{
    public function index()
    {
        return Language::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'language_name' => ['required'],
            'language_name_native' => ['required'],
        ]);

        return Language::create($data);
    }

    public function show(Language $language)
    {
        return $language;
    }

    public function update(Request $request, Language $language)
    {
        $data = $request->validate([
            'language_name' => ['required'],
            'language_name_native' => ['required'],
        ]);

        $language->update($data);

        return $language;
    }

    public function destroy(Language $language)
    {
        $language->delete();

        return response()->json();
    }
}
