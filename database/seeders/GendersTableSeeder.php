<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data to be inserted into tbl_genders
        $data = [
            [
                'id' => 1,
                'gender' => 'Male',
                'created_by' => 1,
                'created_at' => '2024-06-19',
                'updated_at' => '2024-06-19',
            ],
            [
                'id' => 2,
                'gender' => 'Female',
                'created_by' => 1,
                'created_at' => '2024-06-19',
                'updated_at' => '2024-06-19',
            ],
            [
                'id' => 3,
                'gender' => 'Others',
                'created_by' => 1,
                'created_at' => '2024-06-19',
                'updated_at' => '2024-06-19',
            ],
        ];

        // Insert data into the table
        DB::table('tbl_genders')->insert($data);
    }
}
