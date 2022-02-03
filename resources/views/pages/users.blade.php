@extends('dashboard')
@section('content')
<table class="table my-3">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">имя</th>
            <th scope="col">email</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td> 
                    <a href="/deleteUser/{{$user->id}}">[удалить]</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection