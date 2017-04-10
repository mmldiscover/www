<?php
namespace app\index\controller;

use think\Controller;
use think\response\View;
use think\Session;

class Menu extends Controller
{
    function index(){
        $menus = model('Menu')->where('menu_status',1)->paginate();
        // 把分页数据赋值给模板变量list
        $this->assign('allmenu',$menus);
        return view();
    }
    function add(){
        if(input('post.')){
            $data= input('post.');
            $menu = array(
                'menu_name' =>$data['menu_name'],
                'menu_status'=>$data['menu_status'],
                'menu_parent' =>$data['menu_parent'],
                'controller' => $data['controller'],
                'function' =>$data['function'],
                'role_id' =>$data['role_id'],
                'icon' =>$data['icon']
            );

            $res = model('Menu')->save($menu);
            if($res){
                return __msg(1,'success');
            }
            else{
                return __msg(0,'failed');
            }
        }
        $roles = model("Role")->where('role_status',1)->select();
        $this->assign('roles',$roles);
        return view();
    }
    function edit(){
        if(input('param.id')){
            $res = model('Menu')->where('menu_id',input('param.id'))->find();
            if($res){
                $roles = model("Role")->where('role_status',1)->select();
                $this->assign('roles',$roles);
                $this->assign('m',$res);
                return View();
            }
        }
    }
    function update(){
        if(input('post.')){
            $data= input('post.');
            $menu = array(
                'menu_name' =>$data['menu_name'],
                'menu_status'=>$data['menu_status'],
                'menu_parent' =>$data['menu_parent'],
                'controller' => $data['controller'],
                'function' =>$data['function'],
                'role_id' =>$data['role_id'],
                'icon' =>$data['icon']
            );

            $res = model('Menu')->where('menu_id',$data['menu_id'])->update($menu);
            if($res){
                return __msg(1,'success');
            }
            else{
                return __msg(0,'failed');
            }
        }

    }
    function delete(){
        $id = input('post.id');
        if($id){
            $res = model('Menu')->where('menu_id',$id)->delete();
            if($res){
                return __msg(1,'success');
            }
            else{
                return __msg(0,'failed');
            }
        }
    }

}
