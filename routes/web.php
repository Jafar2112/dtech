<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\BlogController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\MessageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();

Route::group(['middleware'=>'auth'],function (){

    Route::group(['prefix' => '/blog-create/'], function () {

        Route::get('content', [BlogController::class, 'contentCreate'])
            ->name('blog.content_create');

        Route::post('content', [BlogController::class, 'contentStore'])
            ->name('blog.content_store');

        Route::get('content/{id}',[BlogController::class,'contentEdit'])
            ->name('blog.content_edit');

        Route::put('content/{id}',[BlogController::class,'contentUpdate'])
            ->name('blog.content_update');

        Route::get('image/{id}', [BlogController::class, 'imageCreate'])
            ->name('blog.image_create');

        Route::post('image/{id}', [BlogController::class, 'imageStore'])
            ->name('blog.image_store');
    });


    Route::get('/message/{id}', [MessageController::class, 'index']);
    Route::post('/message/{id}', [MessageController::class, 'store']);


    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/blog',[HomeController::class,'blog']);
    Route::get('/data',[HomeController::class,'get']);


    Route::post('/comment/{id}', [CommentController::class, 'store'])->name('comment.store');
    Route::get('/',function (){return redirect('/home');});
});

