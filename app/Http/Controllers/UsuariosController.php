<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function index()
    {
        return view('usuarios.index', [
            'usuarios' => User::latest()->paginate()
        ]);
    }

    public function update(Request $request, User $usuario)
    {
        $usuario->update(['rol' => $request->rol]);

        return view('usuarios.index', [
            'usuarios' => User::latest()->paginate()
        ]);
    }

}
