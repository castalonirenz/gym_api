<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('user')
            ->insert([
            'user_username' =>'castaloni',
            'user_pass'=> '1234',
            'user_type'=> 'goers',
            'user_fname'=> 'renz',
            'user_lname'=> 'castaloni',
            'security_id'=> 'who',
            'user_SecAnswer'=>'something'
        ]);
    }
}
