<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeder para insertar usuario administrador
        DB::table('users')->insert([
            ['rol' => 'Administrador',
            'nombre' => 'Carlos Orozco García',
            'alias' => 'MC. Orozco',
            'email' => 'corozcog@upv.edu.mx',
            'password' => Hash::make('admin')],

            ['rol' => 'Trabajador',
            'nombre' => 'Mariana Nallely Rodríguez',
            'alias' => 'Lic. Mariana',
            'email' => 'mrodriguezg@upv.edu.mx',
            'password' => Hash::make('1234')]
        ]);
    }
}
