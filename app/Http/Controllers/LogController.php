<?php

namespace App\Http\Controllers;
use App\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class LogController extends Controller
{
    //
        public function timeIn(Request $request){
            $this->validate($request, [
                'customer_id' => 'required',
                'time_in' => 'required',
                'log_date' => 'required'
                ]);
                // $user = Login::where(['user_username' => $request->input('username'), 
                // 'user_pass' => $request->input('password')])->first();
                $checkExist = DB::table('customer')
                ->where(['cust_id' => $request->input('customer_id')])
                ->first();
                if($checkExist !== null){

                    $timeInToday = DB::table('log')
                    ->where(['log_date' => $request->input('log_date')])
                    ->first();
                         
                    if($timeInToday === null)
                {    
                    $time = DB::table('log')
                    ->insertGetid([
                        'cust_id' => $request->input('customer_id'), 
                        'log_in' => $request->input('time_in'),
                        'log_date' => $request->input('log_date')
                        ]);

                        if(empty($time)){    
                            return response()->json(['status' => 'Please try again']);
                         }
                         else{
                            $users = DB::table('log')
                            ->where(['cust_id' => $request->input('customer_id')])
                            ->select('log_in', 'log_date')
                            ->orderBy('log_id', 'desc')
                            ->limit(1)
                            ->get();
                            return 
                            response()
                            ->json([
                                'status' => 'success',
                                'details'=>$users], 
                                201);
                         }
                }
                else{
                         return 
                            response()
                            ->json([
                                'status' => 'you have already time in today',
                                'details'=>$timeInToday], 
                                201);
                }
                
                }
                else if($checkExist === null){
                   return
                    response()->json([
                    'error' => true,
                    'message' => 'customer id doesnt exist']);
                }
                // ->json(['respon' => $checkExist]);
                
                       

        }

        public function timeOut(Request $request){
            $this->validate($request, [
                'customer_id' => 'required',
                'time_out' => 'required',
                'log_date' => 'required'
                ]);
                $time = DB::table('log')
                    ->where([
                        'cust_id' => $request->input('customer_id'),
                        'log_date' => $request->input('log_date')
                            ])
                    ->orderBy('log_in')
                    ->limit(1)
                    ->update(['log_out' => $request->input('time_out')]);
                if(empty($time)){    
                            return response()
                            ->json([
                                'status' => 'error',
                                'message' => 'no time in'
                            ]);
                         }
                    else{
                            $users = DB::table('log')
                            ->where(['cust_id' => $request->input('customer_id')])
                            ->select('cust_id','log_in','log_out', 'log_date')
                            ->orderBy('log_id', 'desc')
                            ->limit(1)
                            ->get();
                            return response()->json(['status' => $users], 201);
                    }
                
                       

        }

        public function showLog(Request $request){
            $this->validate($request, [
                'customer_id' => 'required',
                ]);
            $logs = DB::table('log')
            ->where(['cust_id' => $request->input('customer_id')])
            ->get();
            return response()->json(['status' => $logs], 201);
        }
}
