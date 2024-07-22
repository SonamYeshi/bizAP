<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data to be inserted into tbl_job_statuses
        $data = [
            [
                'id' => 1,
                'status' => 'Employed',
                'created_by' => 1,
                'created_at' => '2024-06-19',
                'updated_at' => '2024-06-19',
            ],
            [
                'id' => 2,
                'status' => 'Unemployed',
                'created_by' => 1,
                'created_at' => '2024-06-19',
                'updated_at' => '2024-06-19',
            ],
            [
                'id' => 3,
                'status' => 'Other',
                'created_by' => 1,
                'created_at' => '2024-06-19',
                'updated_at' => '2024-06-19',
            ],
        ];

        // Insert data into the table
        DB::table('tbl_job_statuses')->insert($data);
    }
}
