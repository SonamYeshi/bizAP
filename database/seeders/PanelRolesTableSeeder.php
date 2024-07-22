<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PanelRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert data into the database
        DB::table('tbl_panelroles')->insert([
            [
                'id' => 1,
                'rolename' => 'Chairperson',
                'active' => 1,
                'created_at' => '2024-06-19',
                'updated_at' => null,
                'created_by' => 1,
            ],
            [
                'id' => 2,
                'rolename' => 'Member',
                'active' => 1,
                'created_at' => '2024-06-19',
                'updated_at' => null,
                'created_by' => 1,
            ],
        ]);
    }
}
