<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('private.home', ['title' => 'Home']);
})->name('home');

// Private Blog Route
Route::get('/admin/blog', [BlogController::class, 'adminBlog'])->name('blog');
Route::get('/admin/blog/trash', [BlogController::class, 'trash'])->name('trashBlog');
Route::get('/admin/blog/trash/{slug}', [BlogController::class, 'trashDetail'])->name('detailTrashBlog');
Route::delete('/admin/blog/delete/{slug}', [BlogController::class, 'delete'])->name('deleteBlog');
Route::get('/admin/blog/restore/{slug}', [BlogController::class, 'restore'])->name('restoreBlog');
Route::get('/admin/blog/{slug}', [BlogController::class, 'detailBlog'])->name('detailBlog');
Route::post('/admin/blog/create', [BlogController::class, 'create'])->name('createBlog');
Route::patch('/admin/blog/{slug}', [BlogController::class, 'update'])->name('updateBlog');
Route::delete('/admin/blog/{slug}', [BlogController::class, 'softDelete'])->name('softDeleteBlog');

// Public Blog Route
Route::get('/blog', [BlogController::class, 'index'])->name('public_blog');

// Private User Route
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
