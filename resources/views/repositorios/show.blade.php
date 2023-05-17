<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center justify-between">
            Archivos en el Repositorio: {{ $repositorio->title }}
            @if ( Auth::user()->rol == 1)
            <a href="" data-toggle="modal" data-target="#exampleModal" class="text-xs bg-gray-800 text-white rounded px-2 py-1">Agregar Archivo</a>
            @endif
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if ( Auth::user()->rol == 2 && (COUNT($archivos) > 0) )
            
                <h3 class="font-semibold text-xl text-gray-800 leading-tight flex items-center justify-between">
                    Estatus: {{ $estatus->sinDescargar == 0 ? 'Todos los Archivos ya fueron descargados.' : 'Pendiente '.$estatus->sinDescargar.' Archivo(s) para completar la descarga del Repositorio.'  }}
                </h3>

                @endif

                <div class="p-6 bg-white border-b border-gray-200">

                    @if (COUNT($archivos) == 0)
                        REPOSITORIO SIN ARCHIVOS
                    @else
                    <table class="mb-4 table">
                        <tr class="">
                            <th>id</th>
                            <th>Archivo</th>
                            <th>Estatus</th>
                            <th>Opciones</th>
                        </tr>
                        @foreach ($archivos as $archivo)
                        <tr class="border-b border-gray-200 text-sm">
                            <td class="px-6 py-4">{{ $archivo->id }}</td>
                            <td class="px-6 py-4">{{ $archivo->name }}</td>
                            <td class="px-6 py-4">{{ $archivo->descargas == '0' ? 'Pendiente' : 'Descargado' }}</td>
                            <td class="px-6 py-4">

                                <a href="{{ route('showFile', $archivo->id ) }}" class="text-xs bg-gray-800 text-white rounded px-4 py-2">
                                    Descargar
                                </a>
                                <!--                                
                                <a href="{{ '/uploads/repositorios/'.$repositorio->id.'/'.$archivo->name }}" target="_blank">ver</a>
                                -->
                            </td>
                        </tr>
                        @endforeach

                    </table>

                    {{ $archivos->links() }}

                    @endif
                </div>
                <div class="flex items-center justify-between">
                    <a href=" {{ route('repositorios.index') }} ">Volver</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Subir Archivo para el Repositorio: {{ $repositorio->title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="custom-file">
                            <input type="hidden" name="repositorio_id" value="{{ $repositorio->id }}" >
                            <input type="hidden" name="user_id" value="1" >
                            <input type="file" name="file" class="custom-file-input" id="chooseFile">
                            <label class="custom-file-label" for="chooseFile">Selecciona tu Archivo</label>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary btn-block mt-4 bg-gray-800 text-white rounded px-2 py-1">
                            Subir Archivos
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    
                </div>
            </div>
        </div>
    </div>

</x-app-layout>