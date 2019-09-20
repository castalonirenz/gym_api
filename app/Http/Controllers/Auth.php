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

       public function changePassword(Request $request)
       {
           $this->validate($request, [
               'username' => 'required',
               'password' => 'required',
               'new_password' => 'required',
               'confirm_password' => 'required'
           ]);

           $newPass = $request->input('new_password');
           $confirmPass = $request->input('confirm_password');

           if($newPass === $confirmPass)
           {
               $user = DB::table('customer')
                                ->where([
                                    'cust_username' => $request->input('username'),
                                    'cust_password' => $request->input('password')
                                        ])
                                ->update(['cust_password' => $request->input('new_password')]);
                                // ->get();
                               
             if(!empty($user)){
                    return
                response()
                ->json(['status' => 'success',
                        'updated' => $user
                        ]);
               }
                    return
                response()
                ->json(['status' => 'fail',
                        'message' => 'check your username or password if correct'
                        ]);

                                
              
           }
           else{
               return
               response()
               ->json(['status' => 'failed',
                        'message' => 'confirm password doesnt match']);
           }
       }
 
}
