<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\CommentController;
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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/ideas/{idea}', [IdeaController::class, 'show'])->name('ideas.show');

Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit'])->name('ideas.edit');

Route::put('/ideas/{idea}', [IdeaController::class, 'update'])->name('ideas.update');

Route::post('/ideas', [IdeaController::class, 'create'])->name('ideas.create');

Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy'])->name('ideas.destroy');

//comments
Route::post('/ideas/{idea}/commnets', [CommentController::class, 'store'])->name('ideas.comments.store');

Route::get('/comments/{comment}', [CommentController::class,'show'])->name('comments.show');

Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');

Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
