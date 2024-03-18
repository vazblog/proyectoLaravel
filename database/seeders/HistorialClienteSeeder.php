<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistorialClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('historial_cliente')->insert([
            [
                'cliente_id' => 1,
                'fecha' => '2023-05-20',
                'observaciones' => 'Tratamiento: Higiene facial',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cliente_id' => 2,
                'fecha' => '2023-06-15',
                'observaciones' => 'Tratamiento: Tratamiento Cura Detox',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

