<?php

namespace App\Http\Controllers\Auth;

use Redirect;
use URL;
use App\User;
use Auth;
use App\Models\Cart;
use App\Models\LoginLog;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
/**
 * Class AuthController
 * @package App\Http\Controllers\Auth
 */
class AgentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    /**
     * Create a new authentication controller instance.
     *
     * @param Guard $auth
     * @param User $registrar
     */
    public function __construct(Guard $auth, User $registrar)
    {
        $this->auth = $auth;
        //$this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * @return \Illuminate\View\View
     */
    
    public function getLogin()
    {
        return view('agent.layouts.login');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function lead_management_system(Request $request, $email = null, $time = null, $mobile = null){
        try{

           // dd(\encrypt('9572923168'));

            $email = \decrypt($email);
            $mobile = \decrypt($mobile);
            $time = \decrypt($time);
            $ip = $request->getClientIp();

            $date = date('d-m-y H:i');
            $dt = new \DateTime($date);
            $tz = new \DateTimeZone('Asia/Kolkata'); 
            $dt->setTimezone($tz);
            $date = $dt->format('d-m-y H:i');


            //dd(\encrypt($date));
           // $time1 = date('Y-m-d H:i:s', strtotime($date));
            //$time2 = date('Y-m-d H:i:s', strtotime($time));
            // $dt = new \DateTime($time);
            // $tz = new \DateTimeZone('Asia/Kolkata'); 
            // $dt->setTimezone($tz);
            // $time2 = $dt->format('Y-m-d H:i:s');
            // $dt = new \DateTime($date);
            // $dt->setTimezone($tz);
            // $time1 = $dt->format('Y-m-d H:i:s');
            // $punch_in_in  = new Carbon($time2);
            // $punch_out_out    = new Carbon($time1);
            // $working_hr = $punch_in_in->diff($punch_out_out)->format('%H');
            // $working_min = $punch_in_in->diff($punch_out_out)->format('%I');
            // $hr_min = $working_hr*60;
            // $total_min = $hr_min + $working_min;

          //  echo $date.'  '.$time;exit;
         
            if($date == $time){
            $user = User::where('status', 1)->where('user_type', 3)->where('email', $email)->where('mobile', $mobile)->first();
          //  dd($user);
            if($user){
                \Auth::login($user);  
                if (isAgent()) {
                    $LoginLog = new LoginLog();
                    $LoginLog->username = $email;
                    $LoginLog->is_login = 1;
                    $LoginLog->user_id = Auth::id();
                    $LoginLog->ip = $ip;                                                               
                    $LoginLog->save();
                    return redirect()->intended('agent/dashboard');
                }
            } else {
                echo('Oops, something went wrong');
            }
        } else {
           // echo('time');
            return redirect()->route('agent'); 
        }
        } catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
        }
    }


    public function postLogin(Request $request)
    {
    //   dd(\Hash::make($request->password));
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'status' => 1
        ];
       $ip = $request->getClientIp();
        if (!\Request::ajax()) {             
            $validator = (new User)->validateLoginUser($credentials);
            if ($validator->fails()) {
                //dd($validator->messages());
                return redirect()->route('agent')
                    ->withInput()
                    ->withErrors($validator->messages());
            }
            if ($this->auth->attempt($request->only('email', 'password') + ['status' => 1, 'user_type' => 3]) || $this->auth->attempt($credentials + ['user_type' => 3] ))
            {
               // dd('test');
                if (isAgent()) {
                    $LoginLog = new LoginLog();
                    $LoginLog->username = $request->email;
                    $LoginLog->is_login = 1;
                    $LoginLog->user_id = Auth::id();
                    $LoginLog->ip = $ip;
                    $LoginLog->save();
                    return redirect()->intended('agent/dashboard');
                }
            }
            else{
                //dd('tes1t');
                $LoginLog = new LoginLog();
                $LoginLog->username = $request->email;
                $LoginLog->is_login = 0;
                $LoginLog->ip = $ip;
                $LoginLog->save();
                return redirect('/agent/lnxx')->with('error', lang('auth.failed_login'));
            }
        }
        else{
            $validator = (new User)->validateLoginUser($credentials);
            if ($validator->fails()) {
                //return validationResponse(false, 206, "", "", $validator->messages());
                $error = [];
                $messages = $validator->messages();
                foreach ($messages->toArray() as $vky => $vkv) {
                    foreach ($vkv as $k => $v) {
                        $error[] = $v; 
                    }
                }
                $html = '';
                foreach ($error as $k => $v) {
                    $html .= '<li>'.$v.'
                        </li>';
                }
                //return  $html;
                return ['error' => $html, 'url'=>''];
            }
            if ($this->auth->attempt($request->only('email', 'password') + ['status' => 1]) || $this->auth->attempt($credentials))
            {
               $user_data = User::where('email', $request->email)->first();
                $inputs = [
                        'user_id' => authUserIdNull()
                            ];
                $user_id =  authUserIdNull();
               $user_data = User::where('id', $user_id)->first();              
               if($user_data['role'] == 1) {
                return ['url'=> route('welcome')];
            } else{
                $succes= '<li class="alert alert-success" role="alert">Login successful</li>';
                // return Redirect::back();
                $redirectTo = \Session::get('redirect_url');
                return ['succes' => $succes, 'url'=> $redirectTo];
            }
        }
            else{
            $user_w_s = User::where('email', $request->email)->where('status', 0)->first();
            if($user_w_s){
                return ['error' => '<li class="alert alert-danger" style="list-style: none;" role="alert">Kindly activate your account first by clicking on the confirmation email sent on your registered email address.</li>'];
            } else {
                return ['error' => '<li class="alert alert-danger" role="alert">'.lang('auth.failed_login').'</li>'];
            }
            }
        }
        
    }

    public function agentLogout()
    {
        \Auth::logout();
        \Session::flush();
        return redirect()->route('agent');
    }

    /**
     * @return int
     */
    public function loginApi()
    {
        return 1;
    }

    
}