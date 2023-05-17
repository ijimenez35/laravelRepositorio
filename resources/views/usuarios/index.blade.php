<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center justify-between">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (COUNT($usuarios) == 0)
                        SIN USUARIOS
                    @else
                    <table class="mb-4 table">
                        <tr>
                            <th>id</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th class="text-center">Rol</th>
                            <th class="text-center">Estatus</th>
                            @if ( Auth::user()->rol == 1)
                            <th class="text-center">Opciones</th>
                            @endif
                        </tr>
                        @foreach ($usuarios as $usuario)

                        <tr class="border-b border-gray-200 text-sm">
                            <td class="px-6 py-4">{{ $usuario->id }}</td>
                            <td class="px-6 py-4">{{ $usuario->name }}</td>
                            <td class="px-6 py-4">{{ $usuario->email }}</td>
                            <td class="px-6 py-4 text-center">{{ $usuario->rol == '1' ? 'Administrador' : 'Usuario' }}</td>
                            <td class="px-6 py-4 text-center">{{ $usuario->status == '0' ? 'Inactivo' : 'Activo' }}</td>
                            @if ( Auth::user()->rol == 1)

                            <td class="px-6 py-4 text-center">

                            @if ($usuario->rol == '1')
                                <form action="{{ route('usuarios.update', $usuario) }}" method="post" >
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="rol" value="{{ 2 }}">
                                    <input 
                                        type="submit" 
                                        value="Cambiar Rol a Usuario" 
                                        class="bg-gray-800 text-white rounded px-4 py-2"
                                        onclick="return confirm('¿Desea cambiar el Rol?')"
                                    >
                                </form>
                            @else
                                <form action="{{ route('usuarios.update', $usuario) }}" method="post" >
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="rol" value="{{ 1 }}">
                                    <input 
                                        type="submit" 
                                        value="Cambiar Rol a Administrador" 
                                        class="bg-gray-800 text-white rounded px-4 py-2"
                                        onclick="return confirm('¿Desea cambiar el Rol?')"
                                    >
                                </form>

                            @endif

                            </td>
                            @endif
                        </tr>

                        @endforeach
                        
                    </table>

                    {{ $usuarios->links() }}

                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
