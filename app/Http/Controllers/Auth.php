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
               
                $checkPassword = DB::table('customer')
                                    ->where(['cust_password' => $request->input('password'),
                                            'cust_username' => $request->input('username')])
                                    ->first();

                // dd($checkPassword);
                if($checkPassword !== null){
                       $checkNewPassword = DB::table('customer')
                                   ->where(['cust_password' => $newPass])
                                    ->first();

                                    // dd($checkNewPassword);
                                    if($checkNewPassword === null){

                                    
                    $changePass = DB::table('customer')
                                         ->where(['cust_username' => $request->input('username')])
                                        ->update(['cust_password' => $newPass,
                                                  'first_time' => 1]);
                                return
                                response()
                                ->json([
                                    'success' => true,
                                    'data' => 'successfully changed',
                                ]);
                                    }
                                    else{
                                return
                                response()
                                ->json([
                                    'success' => false,
                                    'message' => 'Cannot change password new password is same with the old one'
                                ]);
                                    }
                }
                else{
                                 return
                                response()
                                ->json([
                                    'success' => false,
                                    'message' => 'Wrong password!'
                                ]);
                }
           }
           else{
               return 
               response()
               ->json([
                   'success' => false,
                   'message' => 'confirm password doesnt match']);
           }
       }
 
}
