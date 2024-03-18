<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perfiles')->insert([
            [
                'id' => 1,
                'descripcion' => 'Administrador',
                'tipo' => 'administrador',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'descripcion' => 'Cliente',
                'tipo' => 'cliente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'descripcion' => 'Empleado',
                'tipo' => 'empleado',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}