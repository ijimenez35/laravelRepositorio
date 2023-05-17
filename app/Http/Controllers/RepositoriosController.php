<?php

namespace App\Http\Controllers;

use App\Models\Archivos;
use App\Models\Repositorios;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RepositoriosController extends Controller
{
    public function repositorio()
    {
        return view('repositorios.index', [
            'repositorios' => Repositorios::latest()->paginate()
        ]);
    }

    public function index()
    {
        return view('repositorios.index', [
            'repositorios' => Repositorios::latest()->paginate()
        ]);
    }

    public function create(Repositorios $repositorio)
    {
        return view('repositorios.create', [ 'repositorio' => $repositorio ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|unique:repositorios,title'
        ]);
        
        $repositorio = new Repositorios();
        $repositorio->title = $request->title;
        $repositorio->save();
        
        //$repositorio = $request->create([ 'title' => $request->title ]);

        return redirect()->route('repositorios.edit', $repositorio);
    }

    public function edit(Repositorios $repositorio)
    {
        return view('repositorios.edit', [ 'repositorio' => $repositorio ]);
    }

    public function update(Request $request, Repositorios $repositorio)
    {
        $request->validate([
            'title' => 'required|unique:repositorios,title,'.$repositorio->id
        ]);

        $repositorio->update(['title' => $request->title]);

        return redirect()->route('repositorios.edit', $repositorio);
    }

    public function destroy(Repositorios $repositorio)
    {
        $repositorio->delete();
        return back();
    }

    public function show(Repositorios $repositorio)
    {
        $user_id = '1';

        //$user_id = Auth::id();
        $user_id = auth()->user()->id;

        //if (Auth::check()){
            //$user_id = auth()->user()->id;
            //$user_id = Auth::getUser()->id;
        //}
        //Listado de archivos
        $archivos = DB::table('archivos AS c')->select(DB::raw('c.*, (select count(*) from descargas where descargas.archivos_id = c.id and descargas.user_id = '.$user_id.') as descargas'))->where('repositorio_id', $repositorio->id)->latest()->paginate(5);
        $sinDescargar = 0;
        foreach ($archivos as $archivo) {
            if( $archivo->descargas == '0'){
                $sinDescargar++;
            }
        }
        
        //Creamos un objeto para enviarlo a mi vista
        $estatus = (object) array(
            'sinDescargar' => $sinDescargar
        );
        
        return view('repositorios.show', [ 'repositorio' => $repositorio, 'archivos' => $archivos, 'estatus' => $estatus ]);
    }
}
