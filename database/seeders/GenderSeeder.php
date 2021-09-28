<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->insert([
            [
                'code' => 'm',
                'name' => 'Male',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'f',
                'name' => 'Female',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
