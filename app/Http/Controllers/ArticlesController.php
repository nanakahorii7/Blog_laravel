<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ArticleRequest;

use Carbon\Carbon;

class ArticlesController extends Controller {
    public function index() {
        // $articles = Article::all();
        $articles = Article::latest('published_at')->latest('created_at')
        ->published()
        ->get();
        //作成日の降順に記事をソート
        
        return view('articles.index', compact('articles'));
    }
    public function show(Article $article) {
        return view('articles.show', compact('article'));
    }
    
    public function create() {
        return view('articles.create');
    }

    public function store(ArticleRequest $request) {

        // Article::create($request->validated());
        
        Auth::user()->articles()->create($request->validated());

        return redirect()->route('articles.index')
            ->with('message', '記事を追加しました。');
    }

    public function edit(Article $article) {
        return view('articles.edit', compact('article'));
        
    }
 
    public function update(ArticleRequest $request, Article $article) {
        $article->update($request->validated());
        
        return redirect()->route('articles.show', [$article->id])
             ->with('message', '記事を更新しました。');
     }
     
    public function destroy(Article $article) {
        $article->delete();
        
        return redirect()->route('articles.index')
        ->with('message', '記事を削除しました。');
    }
    
    public function __construct() {
        $this->middleware('auth')
            ->except(['index', 'show']);
    }
}
