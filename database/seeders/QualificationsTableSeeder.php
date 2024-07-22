<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QualificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data to be inserted into tbl_qualifications
        $data = [
            [
                'id' => 1,
                'qualification' => 'High School Class 12',
                'created_by' => 1,
                'created_at' => '2024-06-19',
                'updated_at' => '2024-06-19',
            ],
            [
                'id' => 2,
                'qualification' => 'Certificate',
                'created_by' => 1,
                'created_at' => '2024-06-19',
                'updated_at' => '2024-06-19',
            ],
            [
                'id' => 3,
                'qualification' => 'Diploma',
                'created_by' => 1,
                'created_at' => '2024-06-19',
                'updated_at' => '2024-06-19',
            ],
            [
                'id' => 6,
                'qualification' => 'Bachelor\'s Degree',
                'created_by' => 1,
                'created_at' => '2024-06-19',
                'updated_at' => '2024-06-19',
            ],
            [
                'id' => 7,
                'qualification' => 'Master\'s Degree',
                'created_by' => 1,
                'created_at' => '2024-06-19',
                'updated_at' => '2024-06-19',
            ],
            [
                'id' => 8,
                'qualification' => 'PhD',
                'created_by' => 1,
                'created_at' => '2024-06-19',
                'updated_at' => '2024-06-19',
            ],
        ];

        // Insert data into the table
        DB::table('tbl_qualifications')->insert($data);
    }
}
