<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //
    public $table ="log";
    protected $fillable = [ 'log_data','cust_id'];
}
