<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Login;
use Illuminate\Support\Facades\Hash;
class Auth extends Controller
{
    //
       public function authenticate(Request $request)
   {
       $this->validate($request, [
        'username' => 'required',
        'password' => 'required'
        ]);
      $user = Login::where('user_username', $request->input('username'))->first();

       
        if($user !== null){
            if (Hash::check($request->input('password'), $user->user_password)) {
            return $user;
            }
            
        }
        else{
            return response()->json(['status' => 'credentials not found'], 401);
        }
       }
 
}
