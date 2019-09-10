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
                $time = DB::table('log')
                    ->insertGetid([
                        'cust_id' => $request->input('customer_id'), 
                        'log_in' => $request->input('time_in'),
                        'log_date' => $request->input('log_date')
                        ]);

                        if(empty($time)){    
                            return response()->json(['status' => 'Please try again'], 401);
                         }
                         else{
                            $users = DB::table('log')
                            ->where(['cust_id' => $request->input('customer_id')])
                            ->select('log_in', 'log_data')
                            ->orderBy('log_in', 'desc')
                            ->limit(1)
                            ->get();
                            return response()->json(['status' => $users], 201);
                         }
                
                       

        }

        public function timeOut(Request $request){
            $this->validate($request, [
                'customer_id' => 'required',
                'time_out' => 'required'
                ]);
                $time = DB::table('log')
                    ->where(['cust_id' => $request->input('customer_id')])
                    ->orderBy('log_in')
                    ->limit(1)
                    ->update(['log_out' => $request->input('time_out')]);
                if(empty($time)){    
                            return response()->json(['status' => $time], 401);
                         }
                else{
                            $users = DB::table('log')
                            ->where(['cust_id' => $request->input('customer_id')])
                            ->select('cust_id','log_in','log_out', 'log_date')
                            ->orderBy('log_out', 'desc')
                            ->limit(1)
                            ->get();
                            return response()->json(['status' => $users], 201);
                    }
                
                       

        }
}