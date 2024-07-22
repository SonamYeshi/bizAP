<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = "
            INSERT INTO `tbl_roles` VALUES 
                (1,'DHI','DHI','1','2021-08-10 06:06:44','2021-10-29 08:20:42'),
                (2,'Entrepreneur','Entrepreneur','1','2021-10-28 14:46:48','2021-10-29 08:20:14'),
                (3,'Bank','Bank','1',NULL,NULL),
                (4,'Head of Account','Head of Account','1','2021-11-12 06:55:04','2021-11-12 06:55:04'),
                (5,'Associate Director','Associate Director','1',NULL,NULL),
                (6,'EDD','Enterprise Development Division','1',NULL,NULL),
                (7,'SystemAdmin','System Administrator','1',NULL,NULL),
                (11,'Interviewer','Interviewer','1','2022-06-07 06:26:38','2022-06-07 06:26:38'),
                (12,'Director','Director','1','2022-06-08 10:08:14','2022-06-08 10:08:14');
        ";

        // Execute raw SQL query
        DB::unprepared($sql);
    }
}
