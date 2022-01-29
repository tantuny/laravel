<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Article;
//use App\Supports\simple_html_dom;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $articles = Article::all();
   // $html = new simple_html_dom;
    return view('pages.mainPage', ['articles'=>$articles]);
})->name('main');
Route::get('/blog/{id}', function(Request $request){
    $articleId= $request->id;
    $article = Article::where('id', $articleId)->first();
    return view('pages.article', ['article'=>$article]);
});
Route::get('/addArticle', function(){
    return view('pages.addArticle');
})->middleware('auth');
Route::post('/addArticle', function(Request $request){
    $article= new Article();
    $article->title = $request->title;
    $article->content=$request->input('content');
    $article->author=$request->author;
    $article->save();
    return redirect()->route('main');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
