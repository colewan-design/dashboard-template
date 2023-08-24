<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use DB, Carbon\Carbon;

class RegisterController extends Controller
{
    public function register(Request $request) {
        // dd($request);
        try {
            $find_customer = DB::table('users')
                ->where('email', $request->email)
                ->get();
            if(count($find_customer) > 0) {
                /** return duplicate customer warning */
                return response('User already exists', 500);
            } else {
                $user_ref = $this->generateUserRef($request->name);
                // $customer_model = new Customers();
                // columnSetter($customer_model, $request);
                // $customer_model->user_email = $request->email;
                // $customer_model->password = Hash::make($request->password);
                // $customer_model->customer_ref = $customer_ref;
                // $customer_model->registration_date = Carbon::now()->format('Y-m-d H:m:s');
                // $customer_model->role = 'Customer';
                // $customer_model->save();

                $user_model = new User();
                // columnSetter($user_model, $request);
                // $user_model->name = $request->customer_fname .' '. $request->customer_lname;
                $user_model->name = $request->name;
                $user_model->email = $request->email;
                $user_model->password = Hash::make($request->password);
                $user_model->user_ref = $user_ref;
                $user_model->role = 'Employee';
                $user_model->save();
                return $this->returnResponse(200, 'success', null, 'User successfully saved');
            }
        } catch(Exception $e) {
            return $this->returnResponse(500, 'error', null, 'An error occurred');
        }
        
    }

    private function generateUserRef($name) {
        $name = str_split($name);
        $initials = $name[0];

        $date = Carbon::now()->format('ymd');

        // get number of registrations within the day
        $today_regis_count = DB::table('users')
            ->where('created_at', 'LIKE', Carbon::now()->format('Y-m-d').'%')
            ->selectRaw('count(*) as regis_count')
            ->first();
        $today_regis_count = strval($today_regis_count->regis_count + 1);
        $today_regis_count = str_pad($today_regis_count, 3, '0', STR_PAD_LEFT);

        $user_ref = $initials . $date . $today_regis_count;
        
        return $user_ref;
    }
  
}
