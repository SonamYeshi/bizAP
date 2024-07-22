<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DzongkhagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data to be inserted into mst_dzongkhags
        $data = [
            [
                'dzongkhag_id' => 1,
                'dzongkhag_name' => 'Bumthang',
                'created_by' => 1,
                'created_at' => '2024-06-19 11:40:00',
                'updated_at' => null,
            ],
            [
                'dzongkhag_id' => 2,
                'dzongkhag_name' => 'Chhukha',
                'created_by' => 1,
                'created_at' => '2024-06-19 11:40:00',
                'updated_at' => null,
            ],
            [
                'dzongkhag_id' => 3,
                'dzongkhag_name' => 'Dagana',
                'created_by' => 1,
                'created_at' => '2024-06-19 11:40:00',
                'updated_at' => null,
            ],
            [
                'dzongkhag_id' => 4,
                'dzongkhag_name' => 'Gasa',
                'created_by' => 1,
                'created_at' => '2024-06-19 11:40:00',
                'updated_at' => null,
            ],
            [
                'dzongkhag_id' => 5,
                'dzongkhag_name' => 'Haa',
                'created_by' => 1,
                'created_at' => '2024-06-19 11:40:00',
                'updated_at' => null,
            ],
            [
                'dzongkhag_id' => 6,
                'dzongkhag_name' => 'Lhuentse',
                'created_by' => 1,
                'created_at' => '2024-06-19 11:40:00',
                'updated_at' => null,
            ],
            [
                'dzongkhag_id' => 7,
                'dzongkhag_name' => 'Monggar',
                'created_by' => 1,
                'created_at' => '2024-06-19 11:40:00',
                'updated_at' => null,
            ],
            [
                'dzongkhag_id' => 8,
                'dzongkhag_name' => 'Paro',
                'created_by' => 1,
                'created_at' => '2024-06-19 11:40:00',
                'updated_at' => null,
            ],
            [
                'dzongkhag_id' => 9,
                'dzongkhag_name' => 'Pema Gatshel',
                'created_by' => 1,
                'created_at' => '2024-06-19 11:40:00',
                'updated_at' => null,
            ],
            [
                'dzongkhag_id' => 10,
                'dzongkhag_name' => 'Punakha',
                'created_by' => 1,
                'created_at' => '2024-06-19 11:40:00',
                'updated_at' => null,
            ],
            [
                'dzongkhag_id' => 11,
                'dzongkhag_name' => 'Samdrup Jongkhar',
                'created_by' => 1,
                'created_at' => '2024-06-19 11:40:00',
                'updated_at' => null,
            ],
            [
                'dzongkhag_id' => 12,
                'dzongkhag_name' => 'Samtse',
                'created_by' => 1,
                'created_at' => '2024-06-19 11:40:00',
                'updated_at' => null,
            ],
            [
                'dzongkhag_id' => 13,
                'dzongkhag_name' => 'Sarpang',
                'created_by' => 1,
                'created_at' => '2024-06-19 11:40:00',
                'updated_at' => null,
            ],
            [
                'dzongkhag_id' => 14,
                'dzongkhag_name' => 'Thimphu',
                'created_by' => 1,
                'created_at' => '2024-06-19 11:40:00',
                'updated_at' => null,
            ],
            [
                'dzongkhag_id' => 15,
                'dzongkhag_name' => 'Trashigang',
                'created_by' => 1,
                'created_at' => '2024-06-19 11:40:00',
                'updated_at' => null,
            ],
            [
                'dzongkhag_id' => 16,
                'dzongkhag_name' => 'Trashi Yangtse',
                'created_by' => 1,
                'created_at' => '2024-06-19 11:40:00',
                'updated_at' => null,
            ],
            [
                'dzongkhag_id' => 17,
                'dzongkhag_name' => 'Trongsa',
                'created_by' => 1,
                'created_at' => '2024-06-19 11:40:00',
                'updated_at' => null,
            ],
            [
                'dzongkhag_id' => 18,
                'dzongkhag_name' => 'Tsirang',
                'created_by' => 1,
                'created_at' => '2024-06-19 11:40:00',
                'updated_at' => null,
            ],
            [
                'dzongkhag_id' => 19,
                'dzongkhag_name' => 'Wangdue Phodrang',
                'created_by' => 1,
                'created_at' => '2024-06-19 11:40:00',
                'updated_at' => null,
            ],
            [
                'dzongkhag_id' => 20,
                'dzongkhag_name' => 'Zhemgang',
                'created_by' => 1,
                'created_at' => '2024-06-19 11:40:00',
                'updated_at' => null,
            ],
        ];

        // Insert data into the table
        DB::table('mst_dzongkhags')->insert($data);
    }
}
