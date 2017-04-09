<?php
namespace app\index\controller;

use app\index\model\Province;
use think\Controller;
use think\Session;

class School extends Controller
{
    function index(){
        $schools = model('School')->where(['school_status' => array('neq',-1)])->paginate(3);
        $provinces = Province::all();
        $this->assign('schools',$schools);
        $this->assign('provinces',$provinces);
        return view();
    }
    function add(){
        if(input('post.')){
            $data = input('post.');
            $school =array(
                'school_name' => $data['school_name'],
                'school_address'=>$data['school_address'],
                'province_id' =>$data['province_id'],
                'school_status'=>$data['school_status']
            );
            $res = model('School')->save($school);
            if($res){
                return __msg(1,'success');
            }
            else{
                return __msg(0,'failed');
            }
        }
        $provinces = Province::all();
        $this->assign('provinces',$provinces);
        return view();
    }
    function edit(){
        $id = input('param.id');
        if($id){
            $school = model('School')->where('school_id',$id)->find();
            $provinces = Province::all();
            $this->assign('provinces',$provinces);
            $this->assign('school',$school);
            return view();
        }

    }
    function update(){
        if(input('post.')){
            $data = input('post.');
            $school =array(
                'school_name' => $data['school_name'],
                'school_address'=>$data['school_address'],
                'province_id' =>$data['province_id'],
                'school_status'=>$data['school_status']
            );
            $res = model('School')->where('school_id',$data['school_id'])->update($school);
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
            $res = model('School')->where('school_id',$id)->delete();
            if($res){
                return __msg(1,'success');
            }
            else{
                return __msg(0,'failed');
            }
        }
    }
}
