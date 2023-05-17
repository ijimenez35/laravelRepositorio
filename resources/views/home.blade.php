@extends('template')

@section('content')
<div class="bg-gray-900 px-20 py-16 rounded-lg mb-8 relative overflow-hidden">
    <span class="text-xs uppercase text-gray-700 bg-gray-400 rounded-full px-2 py-1">Programación</span>
    <h1 class="text-3xl text-white mt-4">Proyecto de Repositorios</h1>
    <p class="text-sm text-gray-400 mt-2">Proyecto de desarrollo con laravel</p>

    <img src="{{ asset('images/desarrollo.png')}}" class="absolute -right-20 -bottom-20 opacity-20">
</div>
 
<div class="px-4">
    <h1 class="text-2xl mb-8 text-gray-900">Repositorios disponibles</h1>

    <div class="grid grid-cols-1 gap-4 mb-4">

        @foreach ($repositorios as $repositorio)
        <a href="#" class="bg-gray-100 rounded-lg px-6 py-4">
            <p class="text-xs flex items-center gap-2">
                <span class="uppercase text-gray-700 bg-gray-200 rounded-full px-2 py-1">Fecha</span>
                <span>{{ $repositorio->created_at->format('d/m/Y') }}</span>
            </p>

            <h2 class="text-lg text-gray-900 mt-2">{{ $repositorio->title }}</h2>
        </a>
        @endforeach

    </div>
    
</div>
    
@endsection