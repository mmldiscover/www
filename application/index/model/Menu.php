<?php
namespace app\index\model;
/**
 * Created by PhpStorm.
 * User: Progremming
 * Date: 2017/3/21
 * Time: 15:44
 */
class Menu extends \think\Model
{
    function getMenusByRoleId($role_id){
        $first = $this->where(
            array(
                'role_id' => $role_id,
                'menu_parent' => 0
            )
        )->select();
        $result = array();
        foreach ($first as $item){
            $item['child'] = $this->getMenusByParent($item->menu_id,$role_id);
            $result[] = $item;
        }
        return $result;
    }
    function getMenusByParent($parent_id,$role_id){
        $con  = array(
            'menu_parent' => $parent_id,
            'role_id' => $role_id
        );
        return $this->where($con)->select();
    }

}