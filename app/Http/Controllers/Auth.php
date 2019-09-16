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
      $user = Login::where(['user_username' => $request->input('username'), 
        'user_pass' => $request->input('password')])->first();

       
        if($user !== null){
            return
            response()
            ->json(['status' => 'success', 
                'data'=>$user]);
            
            
        }
        else{
            return response()->json(['status' => 'Invalid Credentials'], 401);
        }
       }
 
}
