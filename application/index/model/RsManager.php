<?php
namespace app\index\model;
/**
 * Created by PhpStorm.
 * User: Progremming
 * Date: 2017/3/21
 * Time: 15:44
 */
class RsManager extends \think\Model
{
    //将文件信息存储数据库
    function addResource($data){
        if(!check($data)){
            return 0;
        }
        //对 Table: Resource
        $resource = new Resource();
        $resource->route = $data['route'];
        $resource->size = $data['size'];
        $resource->uploadtime = time();
        $resource->md5 = $data['md5'];
        $resource->filetype = $data['type'];
        $resource->uploader= $data['uploader'];
        $res=$resource->save();
        if(!$res){
            return 0;
        }
        // 对 Table:ResourceFolder 建立 Resource 和 fodler 的关联
        $rfdata = array(
            'folder_id'=>$data['folder_id'],
            'resource_id' =>$resource->resource_id,
            'resource_name' =>$data['resource_name'],
            'user_id' =>$data['uploader'],
            'uploadtime'=>time(),
            'size' =>$data['size'],
        );
        $rf = new ResourceFolder();
        $res=$rf ->save($rfdata);
        if(!$res){
            return 0;
        }
        return 1;
    }

}