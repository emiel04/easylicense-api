<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\JwtAuthController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ReviewController;
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
    Route::group([
        "middleware" => ["auth:api", "auth.csrf.jwt"],
    ], function(){
        Route::get("profile", [JwtAuthController::class, "profile"]);
        Route::get("refresh", [JwtAuthController::class, "refreshToken"]);
        Route::get("logout", [JwtAuthController::class, "logout"]);
    });

});
// Authenticated routes
Route::group([
    "middleware" => ["auth:api", "auth.csrf.jwt", "localisation"],
], function(){
    Route::get('/lessons/title', [LessonController::class, 'allTitles']);
    Route::post('/reviews', [ReviewController::class, 'create']);
    Route::get('/lessons', [LessonController::class, 'all']);
    Route::get('/lessons/{id}', [LessonController::class, 'find']);
    Route::post('/lessons', [LessonController::class, 'create']);


    Route::get('/categories', [CategoryController::class, 'all']);
    Route::post('/categories', [CategoryController::class, 'create']);

    Route::get('/reviews', [ReviewController::class, 'all']);

    Route::group([
        "middleware" => ["admin"],
        "prefix" => "admin",
    ], function(){
        Route::put('/lessons/{id}', [LessonController::class, 'update']);
        Route::delete('/lessons/{id}', [LessonController::class, 'delete']);
    });


});
