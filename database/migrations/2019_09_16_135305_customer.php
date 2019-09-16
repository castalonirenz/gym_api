<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Customer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('customer', function (Blueprint $table) {
            $table->bigIncrements('cust_id');
            $table->string('cust_fname')->nullable();
            $table->string('cust_mname')->nullable();
            $table->string('cust_lname')->nullable();
            $table->string('cust_homeno')->nullable();
            $table->string('cust_street')->nullable();
            $table->string('cust_brgy')->nullable();
            $table->string('cust_city')->nullable();
            $table->integer('cust_age')->nullable();
            $table->string('cust_contact')->nullable();
            $table->string('cust_gender')->nullable();
            $table->string('cust_regdate')->nullable();
            $table->string('cust_expdate')->nullable();
            $table->string('cust_memstatus')->nullable();
            $table->string('cust_username')->nullable();
            $table->string('cust_password')->nullable();
            $table->string('cust_active')->nullable();
            $table->string('cust_qr_code')->nullable();
            

          
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('customer');
    }
}
