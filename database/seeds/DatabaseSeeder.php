<?php

use Illuminate\Database\Seeder;
use Database\seeds\memberSeeder;
use Database\seeds\customerTable;
use Database\seeds\QrTableSeeder;
use Database\seeds\UserTableSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
         $this->call('customerTable');
         $this->call('QrTableSeeder');
         $this->call('UserTableSeeder');
    }
}
