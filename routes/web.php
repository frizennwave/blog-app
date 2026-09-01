<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('public.home', ['title' => 'Home']);
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

// Private News Route
Route::get('/admin/news', [NewsController::class, 'adminNews'])->name('news');
Route::get('/admin/news/trash', [NewsController::class, 'trash'])->name('trashNews');
Route::get('/admin/news/trash/{slug}', [NewsController::class, 'trashDetail'])->name('detailTrashNews');
Route::delete('/admin/news/delete/{slug}', [NewsController::class, 'delete'])->name('deleteNews');
Route::get('/admin/news/restore/{slug}', [NewsController::class, 'restore'])->name('restoreNews');
Route::get('/admin/news/{slug}', [NewsController::class, 'detailNews'])->name('detailNews');
Route::post('/admin/news/create', [NewsController::class, 'create'])->name('createNews');
Route::patch('/admin/news/{slug}', [NewsController::class, 'update'])->name('updateNews');
Route::delete('/admin/news/{slug}', [NewsController::class, 'softDelete'])->name('softDeleteNews');

// Public Blog Route
Route::get('/news', [NewsController::class, 'index'])->name('public_news');


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
