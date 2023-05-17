@extends('template')

@section('content')

    <h1>Archivo</h1>

    <embed src="{{ '/uploads/repositorios/'.$archivo->repositorio_id.'/'.$archivo->name }}" width="100%" height="100%" />

    <div class="flex items-center justify-between">
        <a href="javascript:history.go(-1)">Volver</a>
    </div>

@endsection