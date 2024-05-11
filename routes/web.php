<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\PostCondition;

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

Route::get('/', function () {
    $posts = Post::latest()->get();
    return view('home', compact('posts'));
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/edit/{post}', [PostController::class, 'edit'])->middleware('auth.post')->name('posts.edit');
    Route::patch('/posts/update/{post}', [PostController::class, 'update'])->middleware('auth.post')->name('posts.update');
    Route::delete('/posts/destroy/{post}', [PostController::class, 'destroy'])->middleware('auth.post')->name('posts.destroy');

    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');

    Route::post('/comments/store', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/destroy/{comment}', [CommentController::class, 'destroy'])->middleware('comment.owner')->name('comments.destroy');
});

Route::get('/posts/search', [PostController::class, 'search'])->name('posts.search');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

require __DIR__.'/auth.php';
