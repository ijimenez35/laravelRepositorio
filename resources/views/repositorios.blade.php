@extends('template')

@section('content')

    <h1>listado Repositorios</h1>

    @foreach ($posts as $post)

    <p>
        <strong>{{ $post->id }}</strong>

        <a href="{{ route('repositorio', $post->id ) }}">
            {{ $post->title }}
        </a>
    </p>

    @endforeach

@endsection
