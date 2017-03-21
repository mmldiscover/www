<?php
namespace app\index\controller;

use think\Controller;

class User extends Controller
{
    public function index()
    {

    }

    //添加
    public static function addUser($data){
        if(check($data)) {

            //添加 user
            $user = new \app\index\model\User();
            $user->account = $data['account'];
            $user->password = $data['password'];
            unset($user['user_id']);
            $user->save();

            // 给 user 创建默认文件夹
            $data = array(
                'folder_name'=>'默认文件夹',
                'user_id'=>$user->user_id,
            );
            model('Folder')->save($data);
            return 1;
        }
        return 0;
    }
    public static function getUser($data){
        if(check($data)) {
            $res = model('User')->where($data)->find();
            return $res;
        }
        return 0;
    }

    //注册
    public static function register(){

    }
}
