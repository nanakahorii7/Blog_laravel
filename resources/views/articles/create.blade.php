@extends('layout')

@section('content')
    <h1>Write a New Article</h1>
    
    <hr/>
    
    @include('errors.form_errors')
    
    {!! Form::model($article, ['method' => 'PATCH', 'url' => ['articles', $article->id]]) !!}
        @include('creates.form', ['published_at' => $article->published_at->format('Y-m-d'), 'submitButton' => 'Create Article'])
    {!! Form::close() !!}
    @endsection
        
