<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('municipalities')->insert([
            [
                'code' => 'bagamanoc',
                'id_code' => '052001',
                'name' => 'Bagamanoc',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'baras',
                'id_code' => '052002',
                'name' => 'Baras',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'bato',
                'id_code' => '052003',
                'name' => 'Bato',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'caramoran',
                'id_code' => '052004',
                'name' => 'Caramoran',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'gigmoto',
                'id_code' => '052005',
                'name' => 'Gigmoto',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'pandan',
                'id_code' => '052006',
                'name' => 'Pandan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'panganiban',
                'id_code' => '052007',
                'name' => 'Panganiban (Payo)',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'san_andres',
                'id_code' => '052008',
                'name' => 'San Andres (Calolbon)',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'san_miguel',
                'id_code' => '052009',
                'name' => 'San Miguel',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'viga',
                'id_code' => '052010',
                'name' => 'Viga',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'virac',
                'id_code' => '052011',
                'name' => 'Virac',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
