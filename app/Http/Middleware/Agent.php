<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Auth\Guard;

class Agent
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    public function handle($request, Closure $next)
    {
        
        
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('/');
            }
        }


        if(\Auth::User()->user_type == 3){
            $currentRouteName = Route::currentRouteName();
            return $next($request);
        }
        else{
            return redirect()->route('home');
            //return redirect()->guest('/login');
        }
        
    }
}