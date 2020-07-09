
<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages')->insert([
            'p_name' 		=> 'Room',
            'p_amount' 	=> '5000',
            'p_status'  => '1',
            'created_by'  => '1',
            'updated_by'  => '0',
        ]);
        DB::table('packages')->insert([
            'p_name' 		=> 'Health Care',
            'p_amount' 	=> '5000',
            'p_status'  => '1',
            'created_by'  => '1',
            'updated_by'  => '0',
        ]);
        DB::table('packages')->insert([
            'p_name' 		=> 'F&B',
            'p_amount' 	=> '5000',
            'p_status'  => '1',
            'created_by'  => '1',
            'updated_by'  => '0',
        ]);
        DB::table('packages')->insert([
            'p_name' 		=> 'CHCP',
            'p_amount' 	=> '5000',
            'p_status'  => '1',
            'created_by'  => '1',
            'updated_by'  => '0',
        ]);
        DB::table('packages')->insert([
            'p_name' 		=> 'Trip Express',
            'p_amount' 	=> '5000',
            'p_status'  => '1',
            'created_by'  => '1',
            'updated_by'  => '0',
        ]);
        DB::table('packages')->insert([
            'p_name' 		=> 'Other',
            'p_amount' 	=> '5000',
            'p_status'  => '1',
            'created_by'  => '1',
            'updated_by'  => '0',
        ]);
    }
}
