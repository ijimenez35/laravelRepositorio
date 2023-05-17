@extends('template')

@section('content')

    <h1>Repositorio: {{ $repositorio->title }}</h1>

    <table>
        <tr>
            <th>id</th>
            <th>Archivo</th>
            <th>Estatus</th>
            <th>Opciones</th>
        </tr>
        @foreach ($archivos as $archivo)

        <tr>
            <td>{{ $archivo->id }}</td>
            <td>{{ $archivo->name }}</td>
            <td>{{ $archivo->descargas == '0' ? 'Pendiente' : 'Completado' }}</td>
            <td>
                <form action="{{ route('showFile', $archivo->id) }}" method="post" >
                    @csrf
                    <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                        Descargar
                    </button>
                </form>

                <a href="{{ '/uploads/Hoja.pdf' }}" >ver</a>
            </td>
        </tr>

        @endforeach
        
    </table>

    {{ $archivos->links() }}

    <hr>

    <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="custom-file">
            <input type="hidden" name="repositorio_id" value="{{ $repositorio->id }}" >
            <input type="hidden" name="user_id" value="1" >
            <input type="file" name="file" class="custom-file-input" id="chooseFile">
            <label class="custom-file-label" for="chooseFile">Selecciona tu Archivo</label>
        </div>
        <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
            Subir Archivos
        </button>
    </form>

@endsection