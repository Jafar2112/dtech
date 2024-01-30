<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\UserController;

Route::group(['prefix' => 'admin','middleware' => 'admin'], function () {
    Route::get('/', [DashboardController::class, 'dashboard']);

    Route::get('waiting-blogs', [BlogController::class, 'waitingBlogs']);
    Route::get('/blog/{id}', [BlogController::class, 'showBlog']);
    Route::put('/accept-blog/{id}', [BlogController::class, 'acceptBlog']);

    Route::get('/users', [UserController::class, 'index']);
    Route::delete('/block-user/{id}', [UserController::class, 'blockUser']);

    Route::get('/top-blogs', [BlogController::class, 'topBlogs']);
});
