<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
class ViewController extends Controller
{
    //加载首页
    public function index(Redirector $route){
        
    	return view('admin/index');
    }
    public function login(Request $request,Admin $admin){
        if($request->isMethod('post')){//接收并判断数据的请求类型
            $data=$request->all();//接收所有数据
            //dd($data);
            $res=[//验证信息规则
                "name"=>"required",
                "pwd"=>"required",
                "cod"=>"required|captcha",
            ];
            $mo=[//返回验证信息
                "name.required"=>"用户名不存在",
                "pwd.required"=>"密码错误",
                "cod.required"=>"验证码不能为空",
                "cod.captcha"=>"验证码错误",
            ];
            $cnd=Validator::make($data,$res,$mo);//验证信息
            if($cnd->fails()){//判断是否验证失败
                $request->flash();//返回一次性session
                return redirect()->back()->withErrors($cnd,"Error");//返回错误信息
            }
            $str=$admin->where("name",$data["name"])->first();
            /*dump(Hash::check($data['pwd'],$str->pwd));
            die;*/
            if(!$str){
                $request->flash();//返回一次性session
                return redirect()->back()->withErrors($cnd,"Error");//返回错误信息
            }
            $cct=DB::table('juese')->where('id',$str->qx)->first();
            /*$fff['name']=$data['name'];
            $fff['pwd']=md5($data['pwd']);
            dump(Auth::attempt($fff,$request->has('online')));die;*/
            if(md5($data['pwd'])==$str->pwd){
                if(isset($data["online"])){
                    $ssd=[
                        'time'=>time(),
                        'name'=>$str->name,
                        'qx'=>$cct->name,
                        'aid'=>$str->id,
                        '_token'=>$data['_token'],
                    ];
                    session($ssd);
                    return response('index');
                }else{
                    $ssd=[
                        'time'=>time(),
                        'name'=>$str->name,
                        'qx'=>$cct->name,
                        'aid'=>$str->id,
                    ];
                }
                session($ssd);
                $qp=serialize($ssd);//先序列化数组
                setcookie('ssd',$qp,time()+3600*2);
                return redirect()->to('index');
            }else{
                $request->flash();//返回一次性session
                return redirect()->back()->withErrors($cnd,"Error");//返回错误信息
            }
        }    
    	return view('admin/admin_login');
    }
    public function logingut(Request $request){
        $request->session()->flush();//清除所有session
        setcookie('ssd',null);//清除所有session
        return redirect()->to('login');
    }
}