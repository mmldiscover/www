<?php
namespace app\index\model;
/**
 * Created by PhpStorm.
 * User: Progremming
 * Date: 2017/3/21
 * Time: 15:44
 */
class ResourceFolder extends \think\Model
{
    //获取用户目录下的文件
    function getFolderResource($folder_id){
        $res =  $this->where(
            array(
                'folder_id' => $folder_id,
            )
        )->select();
        return $res;
    }

}