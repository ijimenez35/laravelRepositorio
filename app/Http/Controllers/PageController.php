<?php

namespace App\Http\Controllers;

use App\Models\Repositorios;
use App\Models\Archivos;
use App\Models\Descargas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class PageController extends Controller
{
    public function home()
    {
        $repositorios = Repositorios::get();
        return view('home', ['repositorios' => $repositorios]);
    }
    
    public function usuarios()
    {
        //Consulta a la DB
        $usuarios = User::get();

        return view('usuarios', ['posts' => $usuarios]);
    }

    public function repositorios()
    {
        //Consulta a la DB
        $repositorios = Repositorios::get();

        return view('repositorios', ['posts' => $repositorios]);
    }

    public function repositorio(Repositorios $repositorio)
    {
        
        //$archivos = Archivos::get();
        //$archivos = Archivos::find(2);
        //$archivos = Archivos::where('repositorio_id', $repositorio->id)->latest()->paginate(5);

        //$user_id = '1';
        $user_id = auth()->user()->id;

        //Consulta a la DB
        $archivos = DB::table('archivos AS c')->select(DB::raw('c.*, (select count(*) from descargas where descargas.archivos_id = c.id and descargas.user_id = '.$user_id.') as descargas'))->where('repositorio_id', $repositorio->id)->latest()->paginate(5);
        
        //dd($archivos);

        return view('repositorio', ['repositorio' => $repositorio, 'archivos' => $archivos] );
    }

    public function fileUpload( Request $req ) {

        $user_id = '1';

        /*
        if (Auth::check()){
            $user_id = auth()->user()->id;
            //$user_id = Auth::getUser()->id;
        }
        */

        $req->validate([ 'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048' ]);

        $fileModel = new Archivos;
        if($req->file()) {

            $user_id = auth()->user()->id;

            //$fileName = time().'_'.$req->file->getClientOriginalName();
            $fileName = $req->file->getClientOriginalName();
            
            Storage::disk('public_uploads')->put('/repositorios/'.$req->repositorio_id.'/'.$fileName, file_get_contents($req->file('file')));
            //$filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
            
            //guardar en base de datos
            $fileModel->name = $fileName;
            $fileModel->repositorio_id = $req->repositorio_id;
            $fileModel->user_id = $user_id;
            $fileModel->save();
            
            return back()->with('success','File has been uploaded.')->with('file', $fileName);

        }
    }

    public function showFile( Archivos $archivo ){

        $user_id = auth()->user()->id;
        
        //Insert en la tabla la descarga del archivo
        $model = new Descargas;
        $model->archivos_id = $archivo->id;
        $model->user_id = $user_id;
        $model->save();

        return view('seeFile', ['archivo' => $archivo] );

    }
}
