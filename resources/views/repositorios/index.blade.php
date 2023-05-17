<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center justify-between">
            {{ __('Repositorios') }}
            @if ( Auth::user()->rol == 1)
            <a href="{{ route('repositorios.create') }}" class="text-xs bg-gray-800 text-white rounded px-2 py-1">Crear Repositorios</a>
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (COUNT($repositorios) == 0)
                        SIN REPOSITORIOS
                    @else
                    <table class="mb-4 table">
                        <tr>
                            <th>id</th>
                            <th>Nombre</th>
                            <th class="text-center">Estatus</th>
                            <th class="text-center">Ver Archivos</th>
                            @if ( Auth::user()->rol == 1)
                            <th class="text-center">Editar</th>
                            <th class="text-center">Eliminar</th>
                            @endif
                        </tr>
                        @foreach ($repositorios as $repositorio)

                        <tr class="border-b border-gray-200 text-sm">
                            <td class="px-6 py-4">{{ $repositorio->id }}</td>
                            <td class="px-6 py-4">{{ $repositorio->title }}</td>
                            <td class="px-6 py-4 text-center">{{ $repositorio->status == '0' ? 'Inactivo' : 'Activo' }}</td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('repositorios.show', $repositorio) }}" class="bg-gray-800 text-white rounded px-4 py-2">Ver</a>
                            </td>
                            @if ( Auth::user()->rol == 1)
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('repositorios.edit', $repositorio) }}" class="bg-gray-800 text-white rounded px-4 py-2">Editar</a>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('repositorios.destroy', $repositorio) }}" method="post" >
                                    @csrf
                                    @method('DELETE')
                                    <input 
                                        type="submit" 
                                        value="Eliminar" 
                                        class="bg-gray-800 text-white rounded px-4 py-2"
                                        onclick="return confirm('¿Desea eliminar?')"
                                    >
                                </form>
                            </td>
                            @endif
                        </tr>

                        @endforeach
                        
                    </table>

                    {{ $repositorios->links() }}

                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
