<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empleado')->insert([
            [
                'user_id' => 1,
                'salario' => 2500.00,
                'rol_empleado' => 'medico',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'salario' => 1800.00,
                'rol_empleado' => 'estetico',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'salario' => 1600.00,
                'rol_empleado' => 'estetico',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'salario' => 1500.00,
                'rol_empleado' => 'auxiliar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'salario' => 1400.00,
                'rol_empleado' => 'auxiliar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 6,
                'salario' => 1500.00,
                'rol_empleado' => 'recepcionista',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
