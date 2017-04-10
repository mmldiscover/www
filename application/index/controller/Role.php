<?php
namespace app\index\controller;

use think\Controller;
use think\Session;

class Role extends Controller
{
    function index(){
        $roles = model('Role')->where('role_status',1)->paginate();
        $this->assign('roles',$roles);
        return view();
    }
}
