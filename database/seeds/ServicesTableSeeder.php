<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            'bill_no' 		=> 'slc-1',
            'customer_id'       => '1',
            'package_id' 		=> '4',
            'service_discount' 	=> '5',
            'amount' 			=> '12345',
            'service_date' 		=> '2020-02-28',
            'remark' 			=> 'Test Remark',
            'created_by' 		=> '1',
            'updated_by' 		=> '1',
        ]);
        DB::table('services')->insert([
            'bill_no'       => 'slc-2',
            'customer_id' 		=> '2',
            'package_id' 		=> '3',
            'service_discount' 	=> '5',
            'amount' 			=> '12345',
            'service_date' 		=> '2020-02-29',
            'remark' 			=> 'Test Remark',
            'created_by' 		=> '1',
            'updated_by' 		=> '1',
        ]);
    }
}
