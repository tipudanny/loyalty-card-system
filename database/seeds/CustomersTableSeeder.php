<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'name' 				=> 'Customer 1',
            'email' 			=> 'customer1@gmail.com',
            'phone' 			=> '212345678',
            'address' 			=> 'Dhaka',
            'dob' 				=> '1993-12-18',
            'card_no' 			=> '1234567',
            'card_issu_date' 	=> '2020-12-20',
            'card_expire_date' 	=> '2022-12-20',
            'created_by'        => '1',
            'updated_by'        => '1',
        ]);
        DB::table('customers')->insert([
            'name' 				=> 'Customer 2',
            'email' 			=> 'customer2@gmail.com',
            'phone' 			=> '11234568',
            'address' 			=> 'Kushtia',
            'dob' 				=> '1993-12-20',
            'card_no' 			=> '12345678',
            'card_issu_date' 	=> '2020-12-20',
            'card_expire_date' 	=> '2022-12-20',
            'created_by'        => '1',
            'updated_by'        => '1',
        ]);
    }
}

