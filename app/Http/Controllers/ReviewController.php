<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Modules\Reviews\ReviewService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReviewController extends ApiServiceController
{
    public function __construct(ReviewService $service)
    {
        $this->service = $service;
    }

}
