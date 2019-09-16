<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    //
    public $table = "customer";
    protected $fillable = ['user_username', 'user_pass'];
       protected $hidden = [
        'user_pass'
          ];
}
