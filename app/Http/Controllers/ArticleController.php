<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Supports\simple_html_dom;
use App\Supports\HelpMethod;

class ArticleController extends Controller
{
    public static function showArticles(){
        $articles = Article::all();
    foreach ($articles as $article){
        $html = new simple_html_dom();
        $content = $article->content;
        $html->load($content);
        $article->content =  mb_substr($html->plaintext, 0, 90).'...';
    }
    return view('pages.mainPage', ['articles'=>$articles]);
    }

    public static function showAddArticles(){
        return view('pages.addArticle');
    }
    public static function addArticles(Request $request){
        $content = $request->input('content');
        $html = new simple_html_dom();
        $html->load($content);
        foreach ($html->find('img') as $img){
            if(!strripos($img->src, 'base64')) continue;
            $img->src = HelpMethod::base64_to_image($img->src);
        }
        $content = $html->save();
        $article = null;
        if(empty($request->id)){
            $article = new Article();
        }else{
            $article = Article::where('id', $request->id)->first();
        }
        $article->title = $request->title;
        $article->content = $content;
        $article->author = $request->author;
        $article->save();
        return json_encode(['result'=>'success']);
    }
    public static function showOneArticle(Request $request){
        $articleId = $request->id;
        $article = Article::where('id', $articleId)->first();
        return view('pages.article', ['article'=>$article]);

    }
    public static function updateArticle(Request $request){
        $articleId = $request->id;
        $article = Article::where('id', $articleId)->first();
       return view('pages.addArticle', ['article'=>$article]);
    }
    public static function deliteArticle (Request $request){
        Article::where('id', $request->id)->delete();
        return redirect()->route('dashboard');
    }
    public static function dashboard(){
        $articles = Article::all();
        return view('pages.cmsArticles', ['articles'=>$articles]);
    }
}
