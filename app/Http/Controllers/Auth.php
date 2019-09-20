<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Login;
use Illuminate\Support\Facades\DB;
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
      $user = Login::where(['cust_username' => $request->input('username'), 
        'cust_password' => $request->input('password')])->first();

      
        if($user !== null){
            $logs = DB::table('log')
                        ->where(['cust_id' => $user['cust_id']])
                        ->get();
            return response()
            ->json(['status' => 'success', 
                'data'=>$user,
                'logs'=>$logs]);
            
            
        }
        else{
            return response()->json(['status' => 'Invalid Credentials']);
        }
       }
 
}
