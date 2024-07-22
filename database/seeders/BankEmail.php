<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankEmail extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data to be inserted into tbl_bank_email
        $data = [
            [
                'id' => 1,
                'name' => 'Bank Babu',
                'email' => 'sonam.yeshi92@gmail.com',
                'created_at' => '2024-07-19',
                'updated_at' => '2024-07-19',
            ],
        ];

        // Insert data into the table
        DB::table('tbl_bank_email')->insert($data);
    }
}
