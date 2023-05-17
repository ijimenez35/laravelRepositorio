<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\RepositoriosController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/**
 * Route::get    | Cosultar
 * Route::post   | Guardar
 * Route::delete | Eliminar
 * Route::put    | Actualizar
 */

Route::controller(PageController::class)->group(function(){

    Route::get('/', 'home')->name('home');
    //Route::get('/', 'login')->name('login');
    //Route::get('/usuarios', 'usuarios')->name('usuarios');
    //Route::get('/repositorios_', 'repositorios')->name('repositorios');
    //Route::get('/repositorio/{repositorio:id}', 'repositorio')->name('repositorio');

    //Subir archivos a mi repo
    Route::post('/uploadFile', 'fileUpload')->name('fileUpload');

    //Ver archivo de mi repo
    Route::get('/seeFile/{archivo:id}', 'showFile')->name('showFile');

});

Route::resource('/repositorios', RepositoriosController::class)->middleware(['auth']);
Route::resource('/usuarios', UsuariosController::class)->middleware(['auth']);

Route::redirect('/dashboard', 'repositorios')->name('dashboard');

require __DIR__.'/auth.php';
