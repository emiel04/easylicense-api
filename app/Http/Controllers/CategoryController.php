<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Modules\Categories\CategoryService;
use App\Modules\Lessons\LessonService;
use Illuminate\Http\Request;

class CategoryController extends ApiServiceController
{
    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }
}
