<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RubricController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\SubRubricController;
use App\Models\SubRubric;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware("auth:sanctum")->group(function(){
Route::get('/news',[NewsController::class,'index']);
Route::get('/news/news-{news}',[NewsController::class,'getInfo']);
Route::post('/news/create', [NewsController::class,'create']);
Route::post('/news/search', [NewsController::class,'search']);

Route::get('/rubrics',[RubricController::class,'index']);
Route::get('/rubrics/{rubric}',[RubricController::class,'getInfo']);
Route::post('/rubrics/create', [RubricController::class,'create']);
Route::post('/rubrics/search', [RubricController::class,'search']);

Route::get('/authors',[AuthorController::class,'index']);
Route::get('/authors/{author}',[AuthorController::class,'getInfo']);
Route::post('/authors/create', [AuthorController::class,'create']);



Route::get('/subRubrics',[SubRubricController::class,'index']);
// });

