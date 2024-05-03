<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use App\Modules\Reviews\ReviewService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;

class ReviewController extends ApiServiceController
{
    public function __construct(ReviewService $service)
    {
        $this->service = $service;
    }

    public function create(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user->review()->exists()) {
            return response()->json(['message' => Lang::get('validation.unique_review')], Response::HTTP_BAD_REQUEST);
        }

        $data = $request->all();

        $data['user_id'] = $user->id;

        $review = $this->service->create($data);

        return response()->json($review, Response::HTTP_CREATED);
    }


}
