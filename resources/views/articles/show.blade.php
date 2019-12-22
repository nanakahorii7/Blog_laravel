@extends('layout')

@section('content')
    <h1>{{ $article->title }}</h1>
    
    <hr/>
    
    <article>
        <div class="body">{{ $article->body }}</div>
    </article>
    
    @unless ($article->tags->isEmpty())
        <h5>Tags:</h5>
        <ul>
            @foreach($article->tags as $tag)
                <li>{{ $tag->name }}</li>
            @endforeach
        </ul>
    @endunless
    
    @auth
        <a href="{{ route('articles.edit', ['id' => $article->id]) }}"
          class="btn btn-primary"
        >
            編集
        </a>
        <!--{!! Form::open(['method' => 'DELETE', 'url' => ['articles', $article->id], 'class' => 'd-inline']) !!}-->
        <!--    {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}-->
        <!--{!! Form::close() !!}-->
        {!! delete_form(route('articles.destroy', ['id' => $article->id]), '削除') !!}
    @endauth

        <a href= "{{ action('ArticlesController@index')}}" class="btn btn-secondary float-right">
        一覧へ戻る
        </a>
@endsection