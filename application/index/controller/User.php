<?php
namespace app\index\controller;

use think\Controller;
use think\Session;

class User extends Controller
{
    public function index()
    {
        if(Session::has('user')){
            $user = Session::get('user');
            $this->assign('user',$user);
            return view();
        }

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

    //编辑 用户资料
    public function edit(){
        if(Session::has('user')){
            $user = Session::get('user');
            $this->assign('user',$user);
            return view();
        }
    }
    public function update(){
        if(Session::has('user')){
            $user = Session::get('user');
            if(input('post.')){
                if(input('post.user_id') == $user->user_id){
                    $id = input('post.user_id');
                    $data = array(
                        'realname' => input('post.realname'),
                        'email' => input('post.email'),
                        'telephone' => input('post.telephone'),
                        'sex' => input('post.sex'),
                        'birthday'=>input('post.birthday'),
                    );
                    $res = model('user') ->where('user_id='.$id)->update($data);
                    if($res){
                        $u = User::getUser(array('user_id'=>$user['user_id']));
                        Session::set('user',$u);
                        return __msg(1,'更新成功!');
                    }
                    else{
                        return __msg(0,'更新失败!');
                    }
                }
            }
        }
        return 0;
    }

}
