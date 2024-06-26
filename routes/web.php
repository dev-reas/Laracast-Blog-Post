<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/posts/{post:slug}', [PostController::class, 'show']);
Route::post('posts/{post:slug}/comments', [CommentController::class, 'store']);

Route::post('newsletter', NewsletterController::class);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');

Route::get('/{user:username}', [SessionsController::class, 'show']);
Route::get('/{user:username}/settings', [SessionsController::class, 'editProfile']);
Route::get('/{user:username}/settings/password', [SessionsController::class, 'editPassword']);
Route::patch('/{user:username}/update', [SessionsController::class, 'update']);

Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

// Admin
Route::middleware('can:admin')->group(function () {

    Route::resource('admin/posts', AdminPostController::class)->except(['show']);
    // This will route all the RESTful routes. Basically all the routes below are equal in above except for the show

    // Route::post('admin/posts', [AdminPostController::class, 'store']);
    // Route::get('admin/posts/create',  [AdminPostController::class, 'create']);
    // Route::get('admin/posts',  [AdminPostController::class, 'index']);
    // Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit']);
    // Route::patch('admin/posts/{post}', [AdminPostController::class, 'update']);
    // Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy']);
});
