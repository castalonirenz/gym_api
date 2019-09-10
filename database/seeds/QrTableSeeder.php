<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class QrTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('qr')
            ->insert([
            'id' => 1,
            'value' =>'asdjasd',
            'date_created' => 'asdasd',
        ]);
    }
}