<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;
use Closure;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
class rost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        //dd(cookie('ssd'));
        if(isset($_COOKIE['ssd'])){
            $qp=$_COOKIE['ssd'];
            session(unserialize($qp));//数组反序列化
            return $next($request);
        }
        
        if(!session('name',false)){
            echo "<h1>请你先登录</h1>";
            return redirect()->to('login');
        }
        return $next($request);
    }
}
