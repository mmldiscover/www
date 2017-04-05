<?php
namespace app\index\controller;

use think\Controller;
use think\Session;

//文件资源管理
class Rsmanager extends Controller
{
    //主页
    public function index()
    {

        if(Session::has('user')){
            $user = Session::get('user');
            $root = model('Folder')->getUserRootPath($user->user_id);
            if(input('param.folder')){
                $folders = model('Folder')->where(array(
                    'parent_id' =>input('param.folder'),
                    'user_id' => $user->user_id,
                ))->select();
                $path = Folder::getFolderPath(input('param.folder'));
                //获取文件夹 下的文件
                $resource = model('ResourceFolder')->getFolderResource(input('param.folder'));
                $nowfolder = input('param.folder');
            }
            else{
                $nowfolder = $root->folder_id;
                $folders = model('Folder')->where(array(
                    'parent_id' =>$root->folder_id,
                    'user_id' => $user->user_id,
                ))->select();
                $path =[];
                //获取文件夹 下的文件
                $resource = model('ResourceFolder')->getFolderResource($root->folder_id);
            }
            $this->assign('folders',$folders);
            $this->assign('path',$path);
            $this->assign('resource',$resource);
            $this->assign('root',$nowfolder);
            return view('Rsmanager/index');
        }
        else{
            return view('Index/login');
        }
    }
    
}
