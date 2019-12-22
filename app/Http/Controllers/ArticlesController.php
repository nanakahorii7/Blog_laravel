<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
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
        $tag_list = Tag::pluck('name','id');
        return view('articles.create', compact('tag_list'));
    }

    public function store(ArticleRequest $request) {

        // Article::create($request->validated());
        
        $article = Auth::user()->articles()->create($request->validated());
        $article->tags()->attach($request->input('tags'));

        return redirect()->route('articles.index')
            ->with('message', '記事を追加しました。');
    }

    public function edit(Article $article) {
        $tag_list = Tag::pluck('name', 'id');
        return view('articles.edit', compact('article', 'tag_list'));
        
    }
 
    public function update(Article $article, ArticleRequest $request) {
        $article->update($request->validated());
        $article->tags()->sync($request->input('tags'));
        
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
