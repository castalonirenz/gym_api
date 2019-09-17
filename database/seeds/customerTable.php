<?php

use Illuminate\Database\Seeder;

class customerTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
          DB::table('customer')
            ->insert([
            'cust_fname' =>'Carlo',
            'cust_mname'=> 'Salongga',
            'cust_lname' => 'Gadong',
            'cust_homeno' => '87000',
            'cust_street' => 'Pag-asa',
            'cust_age' => 20,
            'cust_contact' => '09273235823',
            'cust_brgy' => 'tipas',
            'cust_city' => 'taguig',
            'cust_gender' => "male",
            'cust_regdate' => 'august 26, 2019',
            'cust_expdate' => 'august 26, 2020',
            'cust_username' => 'gadong',
            'cust_password' => 'sample',
            'cust_active' => 'yes',
            'cust_qr_code' => '1000001'
         ]);
    }
}
