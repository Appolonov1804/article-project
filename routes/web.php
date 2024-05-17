<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/articles/create', [\App\Http\Controllers\ArticleController::class, 'create'])->name('articles.create');
Route::post('/articles', [\App\Http\Controllers\ArticleController::class, 'store'])->name('articles.store');
Route::get('/articles/{article}/edit', [\App\Http\Controllers\ArticleController::class, 'edit'])->name('articles.edit');
Route::patch('/articles{article}', [\App\Http\Controllers\ArticleController::class, 'update'])->name('articles.update');
Route::delete('/articles/article', [\App\Http\Controllers\ArticleController::class, 'destroy'])->name('articles.delete');
Route::get('/articles/delete', [\App\Http\Controllers\ArticleController::class, 'delete']); 

Route::get('/comments/create', [\App\Http\Controllers\ArticleController::class, 'create'])->name('comments.create');
Route::post('/articles/{article}/comments', [\App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
Route::get('/comments/{comment}/edit', [\App\Http\Controllers\CommentController::class, 'edit'])->name('comments.edit');
Route::patch('/comments/{comment}', [\App\Http\Controllers\CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{comment}', [\App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');


Auth::routes();
