<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Mail\WelcomeMail;
use App\Models\Comment;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('public.home', ['title' => 'Home']);
})->name('home');

// Public Blog Route
Route::get('/blog', [BlogController::class, 'index'])->name('public_blog');

// Public Blog Route
Route::get('/news', [NewsController::class, 'index'])->name('public_news');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'passwordEmail'])->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'passwordUpdate'])->name('password.update');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticating']);
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'createUser']);
});

Route::middleware('auth')->group(function () {

    Route::middleware('verified')->group(function () {
        Route::middleware('role:admin,editor')->group(function () {
            Route::get('/dashboard', function () {
                return view('private.dashboard', ['title' => 'Dashboard']);
            })->name('dashboard');

            // Private Blog Route
            Route::get('/admin/blog', [BlogController::class, 'adminBlog'])->name('blog');
            Route::get('/admin/blog/trash', [BlogController::class, 'trash'])->name('trashBlog');
            Route::get('/admin/blog/trash/{slug}', [BlogController::class, 'trashDetail'])->name('detailTrashBlog');
            Route::delete('/admin/blog/delete/{slug}', [BlogController::class, 'delete'])->name('deleteBlog');
            Route::get('/admin/blog/restore/{slug}', [BlogController::class, 'restore'])->name('restoreBlog');
            Route::post('/admin/blog/create', [BlogController::class, 'create'])->name('createBlog');
            Route::patch('/admin/blog/{slug}', [BlogController::class, 'update'])->name('updateBlog');
            Route::delete('/admin/blog/{slug}', [BlogController::class, 'softDelete'])->name('softDeleteBlog');

            // Private News Route
            Route::get('/admin/news', [NewsController::class, 'adminNews'])->name('news');
            Route::get('/admin/news/trash', [NewsController::class, 'trash'])->name('trashNews');
            Route::get('/admin/news/trash/{slug}', [NewsController::class, 'trashDetail'])->name('detailTrashNews');
            Route::delete('/admin/news/delete/{slug}', [NewsController::class, 'delete'])->name('deleteNews');
            Route::get('/admin/news/restore/{slug}', [NewsController::class, 'restore'])->name('restoreNews');
            Route::post('/admin/news/create', [NewsController::class, 'create'])->name('createNews');
            Route::patch('/admin/news/{slug}', [NewsController::class, 'update'])->name('updateNews');
            Route::delete('/admin/news/{slug}', [NewsController::class, 'softDelete'])->name('softDeleteNews');
        });

        Route::middleware('role:admin')->group(function () {
             // Private User Route
            Route::get('/users', [UserController::class, 'index'])->name('user');
            Route::delete('/user/{slug}', [UserController::class, 'softDelete']);
            Route::get('/user/trash/{slug}', [UserController::class, 'trashDetail'])->name('detailTrashUser');
            Route::get('/users/trash', [UserController::class, 'trash'])->name('trashUser');
            Route::get('/user/restore/{slug}', [UserController::class, 'restore']);
            Route::delete('/user/delete/{slug}', [UserController::class, 'delete']);
        });

        // Comment Route
        Route::post('/comment', [CommentController::class, 'store']);
        Route::get('/admin/news/{slug}', [NewsController::class, 'detailNews'])->name('detailNews');
        Route::get('/admin/blog/{slug}', [BlogController::class, 'detailBlog'])->name('detailBlog');
        Route::get('/user/{slug}', [UserController::class, 'detail'])->name('detailUser');

        Route::get('/comments', function () {
            $comments = Comment::with('blog')->get();

            return $comments;
        })->middleware('tokenvalid');
    });

    Route::get('/email/verify', function () {
        if (auth()->user()->hasVerifiedEmail()) {
            return redirect()->intended('dashboard');
        }

        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect(url()->previous());
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware('throttle:6,1')->name('verification.send');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/send-welcome-mail', function () {
    $data = [
        'email' => 'aaa@example.com',
        'password' => 'aaa123',
    ];

    Mail::to('aaa@example.com')->send(new WelcomeMail($data));
});

Route::get('/version', function () {
    return view('welcome');
});
