<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\JwtAuthController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserProgressionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    "prefix" => "auth",
], function(){
    Route::post("register", [JwtAuthController::class, "register"]);
    Route::post("login", [JwtAuthController::class, "login"]);
    Route::post("refresh", [JwtAuthController::class, "refreshToken"]);
    Route::group([
        "middleware" => ["auth:api", "auth.csrf.jwt"],
    ], function(){
        Route::get("profile", [JwtAuthController::class, "profile"]);
        Route::post("logout", [JwtAuthController::class, "logout"]);
    });

});
// Authenticated routes
Route::group([
    "middleware" => ["auth:api", "auth.csrf.jwt", "localisation"],
], function(){
    Route::post('/reviews', [ReviewController::class, 'create']);
    Route::get('/lessons', [LessonController::class, 'all']);
    Route::get('/lessons/{id}', [LessonController::class, 'find']);
    Route::post('/lessons', [LessonController::class, 'create']);
    Route::patch('/progressions/{lesson_id}', [UserProgressionController::class, 'updateOrCreate']);

    Route::get('/categories', [CategoryController::class, 'all']);

    Route::get('/reviews', [ReviewController::class, 'allPaginated']);

    Route::group([
        "middleware" => ["admin"],
        "prefix" => "admin",
    ], function(){
        Route::patch('/lessons/{id}', [LessonController::class, 'update']);
        Route::delete('/lessons/{id}', [LessonController::class, 'delete']);
        Route::delete('/reviews/{id}', [ReviewController::class, 'delete']);
        Route::post('/categories', [CategoryController::class, 'create']);
    });


});
