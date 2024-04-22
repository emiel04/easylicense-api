<?php

namespace App\Http\Controllers;

use App\Models\Review;
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

        if ($user->reviews()->exists()) {
            return response()->json(['message' => Lang::get('validation.unique_review')], 400);
        }

        $data = $request->all();

        $this->validate($request, [
            'rating' => 'required|integer|min:1|max:5',
            'grade' => 'required|integer|min:1|max:50',
            'content' => 'required|string',
        ]);

        $data['user_id'] = $user->id;

        $review = $this->service->create($data);

        return response()->json($review, 201);
    }

}
