<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cliente')->insert([
            [
                'user_id' => 7,
                'suscripcion' => 'N',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 8,
                'suscripcion' => 'S',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
