<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

class UserDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('user_details')->insert([
    		'user_id'	=> 1,
    		'first_name'	=> 'Bruce',
    		'last_name'		=> 'Wayne',
    		'full_name'		=> 'Bruce Wayne',
    		'avatar'		=> '',
    		'address'		=> '1007 Mountain Drive',
    		'city'			=> 'Gotham',
    		'province'		=> 'Cavite',
    		'created_at'	=> Carbon::now(),
    		'updated_at'	=> Carbon::now()
    	]);
    }
}
