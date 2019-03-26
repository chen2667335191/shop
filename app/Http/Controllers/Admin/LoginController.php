<?php

namespace App\Http\Controllers\Admin;

use App\Rbac\AdminUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    //登陆页面
    public function index(Request $request){
        $session = $request->session();
        if ($session->has('user')){

            return redirect('/admin/home');
        }
        return view('admin.login');
    }

    //登陆判断
    //1先根据用户名查询用户是否存在
    //2如果不存在则提示用户不存在
    //3验证密码是否正确
    //4如果正确则成功登陆，否则提示密码错误
    public function doLogin(Request $request){
        $params = $request->all();
        $return =[
            'code' => 2000,
            'msg' =>'登陆成功'
        ];
        //用户名不能为空
        if(!isset($params['username'])||empty($params['username'])){
            $return = [
                'code' => 4001,
                'msg' =>'用户名不能为空'
            ];
            return json_encode($return);
        }
        //密码不能为空
        if(!isset($params['password'])||empty($params['password'])){
            $return = [
                'code' => 4002,
                'msg' =>'密码不能为空'
            ];
            return json_encode($return);
        }
        //根据用户名查询用户信息
        $userInfo = AdminUser::getInfoByname($params['username']);
        if(empty($userInfo)){
            $return = [
                'code' => 4003,
                'msg' => '用户不存在'
            ];
            return json_encode($return);
        }else{
            //校验密码是否正确
            $password = md5($params['password']);
            if($password !== $userInfo['password']){
                $return =[
                    'code' => 4004,
                    'msg' =>'密码错误'
                ];
                return json_encode($return);
            }else{
                $session = $request->session();
                //存储用户id
                $session->put('user.user_id',$userInfo['id']);
                $session->put('user.username',$userInfo['username']);
                $session->put('user.image_url',$userInfo['image_url']);
                $session->put('user.is_super',$userInfo['is_super']);
                return json_encode($return);
            }
        }

    }

    //用户退出页面
    public function loginout(Request $request){
        //清除session
        $request->session()->forget('user');
        return redirect('/admin/login');
    }
}

