<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserControll;
use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

use App\Http\Controllers\insightController;



Route::get('/', [PostController::class, 'publicPosts'])->name('public-posts');

Route::get('/login', function () {
    $posts = [];
    if (auth()->check()) {
        $posts = auth()->user()->usersCoolPosts()->latest()->get();
    }
    return view('home', ['posts' => $posts]);
})->name('login');

Route::get('/web-analytics', [insightController::class, 'index'])->name('web-analytics');


Route::get('/districts/{state}', [LocationController::class, 'getDistricts']);
Route::view('/location-form', 'location-form');
use Illuminate\Support\Facades\Auth;
Route::post('/register', [UserControll::class, 'register'])->name('register.submit');
Route::post('/logout', [UserControll::class, 'logout'])->name('logout');
Route::post('/login', [UserControll::class, 'login'])->name('login.submit');

Route::get('/dashboard', function () {
    $posts = auth()->user()->usersCoolPosts()->latest()->get();
    return view('home', ['posts' => $posts]);
})->middleware('auth')->name('dashboard');


Route::get('/create-post', function () {
    $categories = Category::all();
    return view('create-post', compact('categories'));
})->middleware('auth')->name('create-post');


Route::get('/your-posts', function () {
    $posts = auth()->user()->usersCoolPosts()->latest()->get();
    return view('your-posts', ['posts' => $posts]);
})->middleware('auth')->name('your-posts');

Route::get('/report', function () {
    $posts = auth()->user()->usersCoolPosts()->latest()->get();
    return view('report', ['posts' => $posts]);
})->middleware('auth')->name('report');

Route::post('/create-post',[PostController::class,'createPost']);
Route::get('/edit-post/{post}',[PostController::class,'showEditScreen']);
Route::put('/edit-post/{post}',[PostController::class,'actuallyUpdatePost']);
Route::delete('/delete-post/{post}',[PostController::class,'deletePost']);
Route::put('/profile/image', [UserControll::class, 'updateImage'])->name('profile.image.update');
Route::delete('/profile/image', [UserControll::class, 'deleteImage'])->name('profile.image.delete');
Route::get('/dashboard/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
Route::put('/dashboard/update', [DashboardController::class, 'update'])->name('dashboard.update');
Route::delete('/dashboard/delete', [DashboardController::class, 'destroy'])->name('dashboard.delete');
Route::get('/explore-posts', [PostController::class, 'publicPosts']);
Route::get('/home', [PostController::class, 'home'])->middleware('auth');
Route::middleware('auth')->group(function () {
    Route::post('/post/{post}/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::post('/post/{post}/like', [LikeController::class, 'store'])->name('like.store');
});
Route::get('/explore-posts/{category?}', [PostController::class, 'publicPosts'])->name('explore.posts');



