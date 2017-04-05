<?php
namespace app\index\controller;

use think\Controller;
use think\Session;

class Resource extends Controller
{

    //上传资源
    public function file_upload(){
        if(input('param.folder') && Session::has('user')){
            $user = Session::get('user');
            $file = request()->file('file');
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->rule('md5')->move(APP_PATH . 'file' . DS . 'uploads');
            if($info){
                $file2 = $_FILES['file'];
                $data = array(
                    'resource_name'=>$file2['name'],
                    'route' => $this->transformRoute($info->getSaveName()) ,
                    'uploader'=>$user->user_id,
                    'uploadtime' =>time(),
                    'folder_id' =>input('param.folder'),
                    'size' => $file2['size'],
                    'md5'=>md5_file(APP_PATH . 'file' . DS . 'uploads/'.$this->transformRoute($info->getSaveName())),
                    'type'=>$info->getExtension(),
                );
                $res = model('RsManager')->addResource($data);
                if($res){
                    return __msg(1,'upload success');
                }
                else{
                    return __msg(0,'upload failed');
                }

            }else{
                // 上传失败获取错误信息
                return __msg(0,'upload failed');
            }
            return __msg(0,'upload ??');
        }
    }
    function transformRoute($path){
        return str_replace("\\","/",$path);
    }

    function download(){
        if(input('param.file')){
            $resource = model('ResourceFolder')->where(array(
                'rf_id' =>input('param.file'),
            ))->find();
            $route = getRouteByResId($resource->resource_id);
            $path =APP_PATH . 'file/uploads/'.$route;
            if($resource){
                header('content-disposition:attachment;filename="'. $resource->resource_name.'"');
                header('content-length:'.$resource->size);
                readfile($path);
            }
        }
    }
    
}
