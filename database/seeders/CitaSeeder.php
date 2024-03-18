<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cita')->insert([
            [
                'cliente_id' => 1,
                'fecha_hora' => '2023-05-20 10:00:00',
                'tratamiento_id' => 1,
                'empleado_id' => 1,
                'observaciones' => 'Cliente con piel sensible',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cliente_id' => 2,
                'fecha_hora' => '2023-06-15 15:30:00',
                'tratamiento_id' => 2,
                'empleado_id' => 2,
                'observaciones' => 'Cliente busca relajación',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

