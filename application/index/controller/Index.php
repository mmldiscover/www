<?php
namespace app\index\controller;

use think\Controller;
use think\Session;

class Index extends Controller
{
    //主页
    public function index()
    {
        if(Session::has('user')){
            return view('Index/index');
        }
        else{
        	return view('Index/login');
        }
    }

    //登录
    public function login(){
        if(input('post.')){
            $account = input('post.account');
            $password = input('post.password');
            //验证数据合法性
            if(!$account){
                return __msg(0,'account can not be null');
            }
            if(!$password){
                return __msg(0,'password can not be null');
            }
            $data = array(
                'account'=>$account,
            );
            //验证账号是否存在
            $user = User::getUser($data);
            if($user){
                //验证密码正确性
                if($user->password == $password){
                    Session::set('user',$user);
                    return __msg(1,'Login success');
                }
                return __msg(0,'Password is not right');
            }
            else{
                return __msg(0,'The Account is not existed');
            }
        }
        return view('Index/login');
    }

    //注册
    public function register(){
        if(input('post.')){
            $account = input('post.account');
            $password = input('post.password');
            $password2=input('post.password1');
            //验证数据合法性
            if(!$account){
                return __msg(0,'account can not be null');
            }
            if(!$password){
                return __msg(0,'password can not be null');
            }
            if($password != $password2){
                return __msg(0,'two password are different');
            }
            $data = array(
                'account'=>$account,
            );
            //验证账号是否存在
            $is_existed = User::getUser($data);
            if($is_existed){
                return __msg(0,'The account is existed');
            }
            else{
                $data['password']=$password;
                $res = User::addUser($data);
                if($res){
                    return __msg(1,'register success');
                }
                else{
                    return __msg(0,'register failed');
                }
            }
        }

        return view('Index/register');
    }
}
