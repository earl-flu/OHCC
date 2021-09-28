<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patient_statuses')->insert([
            [
                'code' => 'active',
                'name' => 'Active',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'recovered',
                'name' => 'Recovered',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'transfered',
                'name' => 'Transfered',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'deceased',
                'name' => 'Deceased',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
