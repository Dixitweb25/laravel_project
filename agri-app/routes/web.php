<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasswordOtpController;

// Website routes
Route::prefix('/')->group(function () {
    Route::get('/', fn() => view('web.index'));
    Route::get('/about', fn() => view('web.about'));
    Route::get('/services', fn() => view('web.services'));
    Route::get('/blog', fn() => view('web.blog'));
    Route::get('/blog-details', fn() => view('web.blog-details'));
    Route::get('/contact', fn() => view('web.contact'));
    Route::get('/testimonials', fn() => view('web.testimonials'));
    Route::get('/login', fn() => view('web.login'));
    Route::get('/signup', fn() => view('web.signup'));
    Route::get('/profile', fn() => view('web.profile'));
    Route::get('/edit/profile', fn() => view('web.edit_profile'));

});

// user login 

Route::resource('users', UserController::class);
Route::post('/loginUser', [UserController::class, 'loginUser'])->name('login.user');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// user forgot password

Route::get('/forgot-password', [PasswordOtpController::class, 'showForgotForm'])->name('forgot.password');
Route::post('/send-otp', [PasswordOtpController::class, 'sendOtp'])->name('otp.send');

Route::get('/verify-otp', [PasswordOtpController::class, 'showOtpForm'])->name('verify.otp');
Route::post('/verify-otp', [PasswordOtpController::class, 'verifyOtp'])->name('otp.verify');

Route::get('/reset-password', [PasswordOtpController::class, 'showResetForm'])->name('reset.password');
Route::post('/reset-password', [PasswordOtpController::class, 'resetPassword'])->name('password.reset.submit');

// user blog Post

// Public Routes (Guest or Auth User)
Route::get('blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    Route::get('create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('blogs', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');
});

// likes and comment user side

Route::post('/blog/{blog}/toggle-like', [BlogController::class, 'toggleLike'])
    ->middleware('auth')
    ->name('blogs.toggleLike');
Route::post('blogs/{blog}/comments', [BlogController::class, 'storeComment'])->name('blogs.comments.store');


// Admin Routes

Route::get('/admin', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Manage admin side routes

Route::get('/admin/manageuser', [AdminController::class, 'manageuser'])->name('admin.users');
Route::post('/admin/user/toggle-active', [AdminController::class, 'toggleUserActive'])->name('user.toggleActive');


Route::get('/admin/manageblog', [AdminController::class, 'manageBlog'])->name('admin.blogs');
Route::delete('/admin/blogs/{blog}', [AdminController::class, 'Blogdestroy'])->name('admin.blogs.delete');

Route::get('/admin/comment', [AdminController::class, 'manageComment'])->name('admin.comments');
Route::delete('/admin/comment/{comment}', [AdminController::class, 'commentdestroy'])->name('admin.comment.delete');

Route::get('/admin/like', [AdminController::class, 'showlike'])->name('admin.likes');
Route::delete('/admin/like/{id}', [AdminController::class, 'likedestroy'])->name('admin.like.delete');
