<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('public.home', ['title' => 'Home']);
})->name('home');

// Blog Route
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/trash', [BlogController::class, 'trash'])->name('trashBlog');
Route::get('/blog/trash/{slug}', [BlogController::class, 'trashDetail'])->name('detailTrashBlog');
Route::delete('/blog/delete/{slug}', [BlogController::class, 'delete']);
Route::get('/blog/restore/{slug}', [BlogController::class, 'restore']);
Route::get('/blog/{slug}', [BlogController::class, 'detailBlog'])->name('detailBlog');
Route::post('/blog/create', [BlogController::class, 'create']);
Route::patch('/blog/{slug}', [BlogController::class, 'update']);
Route::delete('/blog/{slug}', [BlogController::class, 'softDelete']);

// User Route
Route::get('/users', [UserController::class, 'index'])->name('user');
Route::get('/user/{slug}', [UserController::class, 'detail'])->name('detailUser');
Route::delete('/user/{slug}', [UserController::class, 'softDelete']);
Route::get('/user/trash/{slug}', [UserController::class, 'trashDetail'])->name('detailTrashUser');
Route::get('/users/trash', [UserController::class, 'trash'])->name('trashUser');
Route::get('/user/restore/{slug}', [UserController::class, 'restore']);
Route::delete('/user/delete/{slug}', [UserController::class, 'delete']);

// Comment Route
Route::post('/comment', [CommentController::class, 'store']);

Route::get('/version', function () {
    return view('welcome');
});
