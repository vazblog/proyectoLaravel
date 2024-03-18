<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
 /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('producto')->insert([
            [
                'nombre' => 'Crema Hidratante',
                'descripcion' => 'Crema facial para hidratar la piel.',
                'precio' => 25.00,
                'stock' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Cera natural',
                'descripcion' => 'Cera natural de abeja con propiedades hidratantes.',
                'precio' => 15.00,
                'stock' => 80,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Aceite Corporal',
                'descripcion' => 'Aceite hidratante para el cuerpo.',
                'precio' => 18.00,
                'stock' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
