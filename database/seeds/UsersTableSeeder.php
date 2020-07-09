<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' 		=> 'Tipu',
            'email' 	=> 'tipu@gmail.com',
            'user_type' => '1',
            'password' 	=> Hash::make('12345678'),
        ]);
        DB::table('users')->insert([
            'name' 		=> 'Danny',
            'email' 	=> 'danny@gmail.com',
            'user_type' => '0',
            'password' 	=> Hash::make('12345678'),
        ]);
    }
}
