<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //
    public $table ="log";
    protected $fillable = [ 'log_date','cust_id'];
}
