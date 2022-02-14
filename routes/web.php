<?php

use App\Models\Article;
use App\Models\User;
use App\Http\Controllers\ArticleController;
use App\Supports\simple_html_dom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

*/
Route::get('/', [ArticleController::class, 'showArticles' ])->name('main');
Route::get('/blog/{id}', [ArticleController::class, 'showOneArticle']);
Route::get('/addArticle', [ArticleController::class, 'showAddArticles'])->middleware('auth');
Route::post('/addArticle', [ArticleController::class, 'addArticles'])->middleware('auth');
Route::get('/updateArticle/{id}', [ArticleController::class, 'updateArticle']);
Route::get('/deleteArticle/{id}', [ArticleController::class, 'deliteArticle'] );

Route::get('/deleteUser/{id}', [UserController:: class, 'deleteUser']);
Route::get('/users',[UserController:: class, 'showUser'] )->middleware(['auth'])->name('users');

Route::get('/dashboard',[ArticleController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';