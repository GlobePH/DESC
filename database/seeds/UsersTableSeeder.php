<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

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
    		'user_type_id'	=> 1,
    		'cluster_id'	=> 0,
    		'email'			=> 'admin@admin.com',
    		'password'		=> bcrypt('admin2016'),
    		'username'		=> 'adminuser',
    		'status' 		=> 1,
    		'created_at'	=> Carbon::now(),
    		'updated_at'		=> Carbon::now()
    	]);
    }
}
