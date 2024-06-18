<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\ArticleController;
use App\Http\Controllers\Frontend\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/article/fetch-articles', [ArticleController::class, 'fetch_articles'])->name('article.fetch');
Route::get('/{slug}', [HomeController::class, 'detail'])->name('article.detail');
Route::get('/comment/{id}/fetch', [HomeController::class, 'fetch'])->name('comment.fetch');
Route::post('/comment/{id}/save', [HomeController::class, 'save_comment'])->name('comment.save');

require __DIR__ . '/admin.php';
