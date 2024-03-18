<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call(TratamientosSeeder::class);
        $this->call(PerfilesSeeder::class);
        $this->call(UsuariosSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(EmpleadoSeeder::class);
        $this->call(HistorialClienteSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(CitaSeeder::class);
        $this->call(FacturaSeeder::class); 
        $this->call(FacturaProductoSeeder::class); 
    }
}
