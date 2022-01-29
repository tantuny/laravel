@extends('layouts.main')
@section('h1' , 'главная страница')
@section('content')
@foreach($articles as $article)
<!-- Post preview-->
<div class="post-preview">
                        <a href="/blog/{{$article->id}}">
                            <h2 class="post-title">{{$article->title}}</h2>
                            <h3 class="post-subtitle">{{$article->content}}</h3>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <a href="#!">{{$article->author}}</a>
                            {{$article->created_at}}
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
@endforeach
@endsection
