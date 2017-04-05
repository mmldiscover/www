<?php
namespace app\index\controller;

use think\Controller;
use think\Session;

class Folder extends Controller
{
    //主页
    public function index()
    {
        if(Session::has('user')){
            $user = Session::get('user');
            return view('Index/index');
        }
        else{
        	return view('Index/login');
        }
    }
    public static function getFolderPath($folder_id){
        return model('Folder')->getRoot($folder_id);
    }
}
