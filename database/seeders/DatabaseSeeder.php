<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(AdminSeeder::class);
        $this->call(DzongkhagsTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(GendersTableSeeder::class);
        $this->call(JobStatusesTableSeeder::class);
        $this->call(PanelRolesTableSeeder::class);
        $this->call(QualificationsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(BusinessTypeSeeder::class);
        $this->call(BankEmail::class);
        $this->call(ICTDHI::class);
    }
}
