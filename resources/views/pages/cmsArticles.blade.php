@extends('dashboard')
@section('content')
    <a href="addArticle" class="btn btn-primary">Добавить статью</a>
    <table class="table my-3">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Автор</th>
            <th scope="col">Дата добавления</th>
            <th scope="col">Управление</th>
        </tr>
        </thead>
        <tbody>
        @foreach($articles as $article)
            <tr>
                <th scope="row">{{$article->id}}</th>
                <td>{{$article->title}}</td>
                <td>{{$article->author}}</td>
                <td>{{$article->created_at}}</td>
                <td>
                    <a href="/updateArticle/{{$article->id}}">[изменить]</a><br>
                    <a href="/deleteArticle/{{$article->id}}">[удалить]</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection