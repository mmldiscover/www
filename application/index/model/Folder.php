<?php
namespace app\index\model;
use think\Session;

/**
 * Created by PhpStorm.
 * User: Progremming
 * Date: 2017/3/21
 * Time: 15:44
 */
class Folder extends \think\Model
{
//    function getFolderById($folder_id,&$result=array()){
//        $con = array(
//           'parent_id' =>$folder_id,
//            'folder_status' => 1
//        );
//        $res = $this->where($con)->select();
//        foreach ($res as $re){
//            $result[] = $re;
//            $this->getFolderById($re->folder_id,$result);
//        }
//        return $result;
//    }
    function getFoldersByUserId($user_id){
        $root = $this->where(array(
            'user_id' => $user_id,
            'parent_id'=>0,
            'folder_status' =>1
        ))->find();
        if($root){
            $folders=$this->getFolderById($root->folder_id);
        }
        return $folders;
    }

    function getRoot($folder_id,$result=array()){
        $res = $this->where(array(
            'folder_id' => $folder_id,
            'folder_status' => 1
        ))->find();
        while($res->parent_id!=0){
            $result[] = $res;
            $res = $this->where(array(
                'folder_id' => $res->parent_id,
                'folder_status'=> 1
            ))->find();
        }
        return array_reverse($result);
    }

    //获取 用户根文件夹
    function getUserRootPath($user_id){
        if(check($user_id,2)){
            return $this->where(array(
                'user_id' =>$user_id,
                'parent_id' => 0,
                'folder_status' => 1
            ))->find();
        }
    }
    //获取用户 文件夹下的文件夹
    function getUserFoldersByParentId($parent_id=0){
        $con = array(
            'parent_id' => $parent_id,
            'user_id' => Session::get('user')->user_id,
            'folder_status' => 1,
        );
        return $this->where($con)->select();
    }

}