<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TratamientosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tratamientos faciales
        DB::table('tratamiento')->insert([
            [
                'nombre' => 'Higiene facial',
                'descripcion' => 'Limpieza facial profunda para eliminar impurezas.',
                'precio' => 35.95,
                'duracion' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Tratamiento Cura Detox',
                'descripcion' => 'Tratamiento facial detoxificante.',
                'precio' => 50.00,
                'duracion' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Tratamiento Vitamina C',
                'descripcion' => 'Tratamiento facial con vitamina C para revitalizar la piel.',
                'precio' => 50.00,
                'duracion' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Lifting facial',
                'descripcion' => 'Tratamiento facial para un efecto lifting.',
                'precio' => 50.00,
                'duracion' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Contorno de ojo',
                'descripcion' => 'Tratamiento específico para el contorno de ojos.',
                'precio' => 50.00,
                'duracion' => 45,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Otros tratamientos faciales...
        ]);

        // Tratamientos corporales
        DB::table('tratamiento')->insert([
            [
                'nombre' => 'Higiene de espalda',
                'descripcion' => 'Limpieza profunda de la espalda.',
                'precio' => 35.95,
                'duracion' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Peeling hidratación profunda',
                'descripcion' => 'Peeling corporal para hidratación profunda.',
                'precio' => 35.95,
                'duracion' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Masaje drenaje linfático (30 min)',
                'descripcion' => 'Masaje de drenaje linfático de 30 minutos.',
                'precio' => 30.95,
                'duracion' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Masaje drenaje linfático (60 min)',
                'descripcion' => 'Masaje de drenaje linfático de 60 minutos.',
                'precio' => 50.00,
                'duracion' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Maderoterapia (60 min)',
                'descripcion' => 'Maderoterapia corporal de 60 minutos.',
                'precio' => 40.00,
                'duracion' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Maderoterapia -- (Bono 5 sesiones)',
                'descripcion' => 'Bono de 5 sesiones de Maderoterapia.',
                'precio' => 190.00,
                'duracion' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Otros tratamientos corporales...
        ]);

        // Masajes
        DB::table('tratamiento')->insert([
            [
                'nombre' => 'Masaje relajante (30 min)',
                'descripcion' => 'Masaje relajante de 30 minutos.',
                'precio' => 25.95,
                'duracion' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Masaje descontracturante (30 min)',
                'descripcion' => 'Masaje descontracturante de 30 minutos.',
                'precio' => 30.95,
                'duracion' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Masaje piernas cansadas (30 min)',
                'descripcion' => 'Masaje para aliviar piernas cansadas de 30 minutos.',
                'precio' => 25.95,
                'duracion' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Masaje relajante (60 min)',
                'descripcion' => 'Masaje relajante de 60 minutos.',
                'precio' => 40.00,
                'duracion' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Masaje descontracturante (60 min)',
                'descripcion' => 'Masaje descontracturante de 60 minutos.',
                'precio' => 50.00,
                'duracion' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Otros masajes...
        ]);

        // Depilación mujer
        DB::table('tratamiento')->insert([
            [
                'nombre' => 'Fosas nasales',
                'descripcion' => 'Depilación de fosas nasales.',
                'precio' => 3.00,
                'duracion' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Labio superior',
                'descripcion' => 'Depilación de labio superior.',
                'precio' => 3.50,
                'duracion' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Otros tratamientos de depilación mujer...
        ]);

        // Diseño de mirada
        DB::table('tratamiento')->insert([
            [
                'nombre' => 'Diseño cejas',
                'descripcion' => 'Diseño de cejas para resaltar la mirada.',
                'precio' => 10.95,
                'duracion' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Limpiar Cejas',
                'descripcion' => 'Depilación para limpiar las cejas.',
                'precio' => 6.95,
                'duracion' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Otros tratamientos de diseño de mirada...
        ]);

        // Depilación hombre
        DB::table('tratamiento')->insert([
            [
                'nombre' => 'Cejas',
                'descripcion' => 'Depilación de cejas.',
                'precio' => 8.95,
                'duracion' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Espalda',
                'descripcion' => 'Depilación de espalda.',
                'precio' => 20.95,
                'duracion' => 45,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Otros tratamientos de depilación hombre...
        ]);

        // Tratamientos médicos
        DB::table('tratamiento')->insert([
            [
                'nombre' => 'Relleno de Arrugas',
                'descripcion' => 'Procedimiento médico para rellenar arrugas.',
                'precio' => 150.00,
                'duracion' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Aumento de Labios',
                'descripcion' => 'Procedimiento médico para aumentar los labios.',
                'precio' => 120.00,
                'duracion' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Otros tratamientos médicos...
        ]);

        // Depilación láser
        DB::table('tratamiento')->insert([
            [
                'nombre' => 'Depilación láser piernas completas',
                'descripcion' => 'Procedimiento de depilación láser en piernas completas.',
                'precio' => 150.00,
                'duracion' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Depilación láser axilas',
                'descripcion' => 'Procedimiento de depilación láser en axilas.',
                'precio' => 50.00,
                'duracion' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Otros tratamientos de depilación láser...
        ]);
    }
}
