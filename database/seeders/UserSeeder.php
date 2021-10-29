<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'first_name' => 'Vincent Ryan',
                'middle_name' => 'Bonifacio',
                'last_name' => 'Valeza',
                'health_facility_id' => null,
                'super_admin' => 1,
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('testpassword'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'first_name' => 'Bryan',
                'middle_name' => 'Bonifacio',
                'last_name' => 'Valeza',
                'health_facility_id' => 1,
                'super_admin' => 0,
                'email' => 'ebmc@gmail.com',
                'password' => bcrypt('testpassword'),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
