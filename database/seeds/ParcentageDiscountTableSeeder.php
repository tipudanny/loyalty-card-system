<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ParcentageDiscountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages_discount')->insert([
            'customer_id' 			=> '1',
            'package_id' 			=> '1',
            'discount_percentage' 	=> '5',
            'updated_by'            => '1',
        ]);
        DB::table('packages_discount')->insert([
            'customer_id' 			=> '1',
            'package_id' 			=> '2',
            'discount_percentage' 	=> '6',
            'updated_by'            => '1',
        ]);
        DB::table('packages_discount')->insert([
            'customer_id' 			=> '1',
            'package_id' 			=> '3',
            'discount_percentage' 	=> '5',
            'updated_by'            => '1',
        ]);
        DB::table('packages_discount')->insert([
            'customer_id' 			=> '1',
            'package_id' 			=> '4',
            'discount_percentage' 	=> '6',
            'updated_by'            => '1',
        ]);
        DB::table('packages_discount')->insert([
            'customer_id' 			=> '1',
            'package_id' 			=> '5',
            'discount_percentage' 	=> '0',
            'updated_by'            => '1',
        ]);
        DB::table('packages_discount')->insert([
            'customer_id' 			=> '1',
            'package_id' 			=> '6',
            'discount_percentage' 	=> '0',
            'updated_by'            => '1',
        ]);

        // For Customer 2 
        DB::table('packages_discount')->insert([
            'customer_id' 			=> '2',
            'package_id' 			=> '1',
            'discount_percentage' 	=> '5',
            'updated_by'            => '1',
        ]);
        DB::table('packages_discount')->insert([
            'customer_id' 			=> '2',
            'package_id' 			=> '2',
            'discount_percentage' 	=> '6',
            'updated_by'            => '1',
        ]);
        DB::table('packages_discount')->insert([
            'customer_id' 			=> '2',
            'package_id' 			=> '3',
            'discount_percentage' 	=> '5',
            'updated_by'            => '1',
        ]);
        DB::table('packages_discount')->insert([
            'customer_id' 			=> '2',
            'package_id' 			=> '4',
            'discount_percentage' 	=> '6',
            'updated_by'            => '1',
        ]);
        DB::table('packages_discount')->insert([
            'customer_id' 			=> '2',
            'package_id' 			=> '5',
            'discount_percentage' 	=> '2',
            'updated_by'            => '1',
        ]);
        DB::table('packages_discount')->insert([
            'customer_id' 			=> '2',
            'package_id' 			=> '6',
            'discount_percentage' 	=> '3',
            'updated_by'            => '1',
        ]);
    }
}
