<?php
namespace app\index\model;
/**
 * Created by PhpStorm.
 * User: Progremming
 * Date: 2017/3/21
 * Time: 15:44
 */
class Power extends \think\Model
{
    function getRoleByUserId($user_id){
        $res = $this->where('user_id',$user_id)->find();
        return $res;
    }

}