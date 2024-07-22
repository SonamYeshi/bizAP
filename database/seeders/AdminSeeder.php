<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon; 

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'System Administrator',
            'email' => 'sonam.yeshi@thimphutechpark.bt',
            'email_verified_at' => Carbon::now(),
            'role_id' => 7,
            'password' => Hash::make('pass@123'), // Make sure this is hashed
            'two_factor_secret' => NULL,
            'two_factor_recovery_codes' => NULL,
            'remember_token' => NULL,
            'current_team_id' => NULL,
            'profile_photo_path' => NULL,
            'created_at' => Carbon::now(),
            'updated_at' => NULL,
        ]);
    }
}
