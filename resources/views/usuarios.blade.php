@extends('template')

@section('content')

    <h1>listado Usuarios</h1>

    @foreach ($posts as $post)

    <p>
        <strong>{{ $post['id'] }}</strong>

        <a href="">
            {{ $post['name'] }}
        </a>
    </p>

    @endforeach

@endsection
