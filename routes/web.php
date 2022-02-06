<?php

use App\Models\Article;
use App\Models\User;
use App\Http\Controllers\ArticleController;
use App\Supports\simple_html_dom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::get('/deleteUser/{id}', function (Request $request){
    User::where('id', $request->id)->delete();
    return redirect()->route('users');
});
Route::get('/users', function(){
$users= User::all();
return view('pages.users' , ['users'=>$users]);
})->middleware(['auth'])->name('users');

Route::get('/dashboard', function () {
    $articles = Article::all();
    return view('pages.cmsArticles', ['articles'=>$articles]);
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';