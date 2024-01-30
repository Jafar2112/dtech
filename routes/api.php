<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;
use \App\Http\Controllers\Api\CommentController;

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
Route::group(['middleware'=>'auth:sanctum'],function (){
    Route::resource('/blogs',BlogController::class);
    Route::resource('/comments',CommentController::class);

});

Route::group(['middleware'=>'admin'],function (){
   Route::get('/blogs/{id}',[\App\Http\Controllers\Api\Admin\BlogController::class,'showBlog']) ;
   Route::get('/waiting-blogs',[\App\Http\Controllers\Api\Admin\BlogController::class,'waitingBlogs']);
   Route::put('/accept-blog',[\App\Http\Controllers\Api\Admin\BlogController::class,'acceptBlog']);
   Route::get('/top-blogs',[\App\Http\Controllers\Api\Admin\BlogController::class,'topBlogs']);
});

Route::get('/users',[\App\Http\Controllers\Api\Admin\UserController::class,'index']);
Route::delete('/users/{id}',[\App\Http\Controllers\Api\Admin\UserController::class,'blockUser']);




