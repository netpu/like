<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
class RostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //列表展示
        switch ($id) {
            case '1':
                $str=DB::table('admin')->where('del','0')->paginate(4);
                return view('admin/admin_list',['str'=>$str]);
            break;
            case '2':
                $str=DB::table('admin')->where('del','1')->paginate(4);
                return view('admin/admin_list',['str'=>$str]);
            break;
            case '3':
                $str=DB::table('juese')->where('deleted_at',null)->paginate(4);
                return view('admin/admin_role',['str'=>$str]);
            break;
            case '4':
                $str=DB::table('auth')->where('deleted_at',null)->paginate(4);
                return view('admin/admin_permission',['str'=>$str]);
            break;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //添加数据内容页面
        switch ($id) {
            case '0':
                $str=DB::table("juese")->get();
                return view('admin/admin_add',['str'=>$str]);
            break;
            case '1':
                return view('admin/admin_role-add');
            break;
            case '2':
                return view('admin/admin_auth');
            break;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Redirector $redirector,$id,Admin $admin)
    {
        //提交数据页面
        $time=date('Y-m-d H:i:s');
        if($id=="2"){
            $data=$request->only('name');
            $roles = [
                'name' => 'required|unique:admin',
            ];
            $message = [
                'name.required' => '角色不能为空！',
            ];
            $validator = Validator::make($data,$roles,$message);
            // 根据验证结果判断
            if( $validator->fails() ){ // 错误则返回true，返回错误信息
                return ['status'=>false,'message'=>$validator->messages()];
            }
            $data['created_at']=$time;
            $info = DB::table('juese')->insertGetId($data);
            if( $info ){
                // 成功！
                return ['status'=>true,'message'=>'添加角色成功！'];
            }else{
                // 失败!
                return ['status'=>false,'message'=>'添加角色失败！'];
            }
        }else if($id=="1"){
            //$data=$request->only("name","pwd",'sex','shouji','email','qx','conter');
            $data=$request->except('_token','pwd2','file');
            $roles = [
                'name' => 'required',
                'shouji' =>'required',
                'email' =>'required',
            ];
            $message = [
                'name.required' => '角色不能为空！',
                'shouji.required' => '手机不能为空！',
                'email.required' => '邮箱不能为空！',
            ];
            $validator = Validator::make($data,$roles,$message);
            // 根据验证结果判断
            if( $validator->fails() ){ // 错误则返回true，返回错误信息
                return ['status'=>false,'message'=>$validator->messages()];
            }
            $data['pwd']=md5($data['pwd']);
            if($request->hasFile('file')){//判断是否有文件上传
                //获取上传的文件
                $file=$request->file('file');
                $hj=['jpg','png','gif','jpeg'];//允许上传的文件后缀
                $te=$file->extension();//获取上传文件的真实后缀
                $dd='/logo'.date('/Y-m-d/');
                $fi=$file->hashName();
                if($file->isValid()&&in_array($te,$hj)){//判断文件是否完整且后缀正常
                    $res=$file->move(public_path().$dd,$fi);
                    if($_POST['logo']!=0){//判断图片是否更替
                        unlink(public_path().'/'.$_POST['logo']);//删除原有图片
                    }
                        $data['logo']=$dd.$fi;//生成随机文件名并保存
                }
            }else{
                $data['logo']=$_POST['logo'];
            }
            $str=$admin->where("name",$_POST['name'])->first();
            //查询一条内容
            if($str){
                $data['updated_at']=$time;
                $admin->where("name",$_POST['name'])->update($data);
                return ['status'=>true,'message'=>'修改管理员成功！'];
            }else{
                $data['created_at']=$time;
                $admin->create($data);
                return ['status'=>true,'message'=>'添加管理员成功！'];
            }
        }else{
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //显示指定数据页面
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ed,$id)
    {
        //显示编辑数据页面
        if($ed=="0"){
            $str=DB::table('admin')->where("admin.id",$id)->first();
            $cct=DB::table('juese')->get();
            return view('admin/admin_edit',['str'=>$str,'cct'=>$cct]);
        }else{
            $str=DB::table('juese')->where("id",$id)->first();
            return view('admin/admin_role-add',['str'=>$str]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //显示编辑提交页面
        $id=$_GET['id'];
        $ed=$_GET['ad'];
        if($ed==2){
            $str=DB::table('admin')->where('id',$id)->update(['qiy'=>"1"]);
        }else{
            $str=DB::table('admin')->where('id',$id)->update(['qiy'=>"0"]);
        }
        return $str;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //删除数据页面
        $id=$_GET['id'];
        if($_GET['del']!=0){
            $str=DB::table('admin')->where('id',$id)->update(['del'=>"0"]);
            return $str;
        }
        $str=DB::table('admin')->where('id',$id)->update(['del'=>"1"]);
        return $str;
    }

}
