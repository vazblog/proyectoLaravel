<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('factura')->insert([
            [
                'cliente_id' => 1,
                'cita_id' => 1, 
                'fecha_emision' => '2023-05-20',
                'tratamiento_id' => 1,
                'total_tratamiento' => 50.00,
                'total_factura' => 75.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cliente_id' => 2,
                'cita_id' => 2, 
                'fecha_emision' => '2023-06-15',
                'tratamiento_id' => 2,
                'total_tratamiento' => 60.00,
                'total_factura' => 75.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
