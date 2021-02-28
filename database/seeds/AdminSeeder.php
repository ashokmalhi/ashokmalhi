<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = [
            [
                'name' 	=> 'AFL Admin',
                'email'    => 'admin@afl.com',
                'email_verified_at' => date("Y-m-d h:i:s"),
                'password'    => Hash::make('admin123'),
                'created_at' 	=> date("Y-m-d h:i:s"),
                'updated_at' 	=> date("Y-m-d h:i:s")
            ],
        ];

        DB::table('users')->insert($adminUser);
    }
}
