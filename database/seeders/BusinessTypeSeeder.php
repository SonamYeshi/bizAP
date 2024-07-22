<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert data
        DB::table('tbl_business_type')->insert([
            ['id' => 1, 'business_type' => 'Food Production', 'created_at' => '2024-06-20', 'updated_at' => null],
            ['id' => 2, 'business_type' => 'General Services', 'created_at' => '2024-06-20', 'updated_at' => null],
            ['id' => 3, 'business_type' => 'ICT Services', 'created_at' => '2024-06-20', 'updated_at' => null],
            ['id' => 4, 'business_type' => 'Waste Management', 'created_at' => '2024-06-20', 'updated_at' => null],
            ['id' => 5, 'business_type' => 'General Production and Manufacturing', 'created_at' => '2024-06-20', 'updated_at' => null],
            ['id' => 6, 'business_type' => 'Agriculture and Forestry', 'created_at' => '2024-06-20', 'updated_at' => null],
        ]);
    }
}
