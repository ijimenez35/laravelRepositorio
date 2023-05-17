@csrf

<label class="uppercase text-gray-700 text-xs">Título</label>
<span class="text-xs text-red-600">@error('title') {{ $message}} @enderror</span>
<input type="text" name="title" class="rounded border-gray-200 w-full mb-4" value="{{ old('title', $repositorio->title) }}">

<div class="flex items-center justify-between">
    <a href=" {{ route('repositorios.index') }} ">Volver</a>

    <input 
        type="submit" 
        value="Enviar" 
        class="bg-gray-800 text-white rounded px-4 py-2"
        onclick="return confirm('¿Desea guardar?')"
    >
</div>
