<?php

use App\Http\Controllers\JwtAuthController;
use App\Http\Controllers\LanguageController;
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
Route::get('/lang/{langCode}', [LanguageController::class, 'getLang']);
Route::get('/lang', [LanguageController::class, 'all']);

Route::group([
    "prefix" => "auth",
    "middleware" => ["localisation"],
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
    Route::patch('/progressions/{lesson_id}', [UserProgressionController::class, 'updateOrCreate']);


    Route::get('/reviews', [ReviewController::class, 'allPaginated']);

    Route::group([
        "middleware" => ["admin"],
        "prefix" => "admin",
    ], function(){
        Route::patch('/lessons/{id}', [LessonController::class, 'update']);
        Route::delete('/lessons/{id}', [LessonController::class, 'delete']);
        Route::post('/lessons', [LessonController::class, 'create']);
        Route::delete('/reviews/{id}', [ReviewController::class, 'delete']);
    });
});
