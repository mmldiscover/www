<?php
namespace app\index\controller;

use think\Controller;
use think\Session;

class Folder extends Controller
{

    //获取 文件夹 路径
    public static function getFolderPath($folder_id){
        return model('Folder')->getRoot($folder_id);
    }
    public function delete(){
        if( input('post.id') ){
            $res = model('Folder')->where('folder_id='.input('param.id'))->update(array('folder_status'=>-1));

            if($res){
                return __msg(1,'delete successed');
            }
            else{
                return __msg(0,'delete failed');
            }
        }
    }
    public function add(){
        $user = Session::get('user');
        if( input('post.') ){
            if(trim(input('post.name'))==""){
                return __msg(0,'The FolderName can not be null');
            }
            $data = array(
                'folder_name'=>input('post.name'),
                'parent_id' => input('post.id'),
                'user_id' =>$user['user_id'],
                'create_time' => time(),

            );
            $res = model('Folder')->save($data);

            if($res){
                return __msg(1,'add successed');
            }
            else{
                return __msg(0,'add failed');
            }
        }
    }


}
