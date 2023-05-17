<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create(['name' => 'Israel Jimenez', 'email' => 'israel@gmail.com', 'rol' => '1']);
        \App\Models\User::factory(1)->create(['name' => 'Armando Sanchez', 'email' => 'armando@gmail.com', 'rol' => '2']);
        // \App\Models\User::factory(1)->create();
        \App\Models\Repositorios::factory(1)->create(['title' => 'Repositorio 1']);
        \App\Models\Repositorios::factory(1)->create(['title' => 'Repositorio 2']);
        
        /*
        \App\Models\Archivos::factory(20)->create(['repositorio_id' => 1]);
        \App\Models\Archivos::factory(15)->create(['repositorio_id' => 2]);

        \App\Models\Descargas::factory(1)->create(['archivos_id' => 1, 'user_id' => 1]);
        \App\Models\Descargas::factory(1)->create(['archivos_id' => 3, 'user_id' => 1]);
        \App\Models\Descargas::factory(1)->create(['archivos_id' => 21, 'user_id' => 2]);
        \App\Models\Descargas::factory(1)->create(['archivos_id' => 23, 'user_id' => 2]);
        */
    }
}
