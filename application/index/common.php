<?php




function check($data,$type=1){
    switch ($type){
        case 1:
            if(is_array($data))
                return true;
            break;
        case 2:
            if(is_numeric($data))
                return true;
            break;
    }
    return false;
}

function __msg($status,$info){
    $msg = array(
      'status' => $status,
        'info' =>$info,
    );
    exit(json_encode($msg)) ;
}
function getUserName($account){
    $user = db('user')->where('account',$account)->find();
    return $user['username'];
}

function transformSize($size){
    	if($size<1024){
    		return $size."B";
    	}
    	else if($size>1024 && $size<1024*1024){
    		return round($size/1024,2)."K";
    	}
    	else if($size>=1024*1024 && $size<1024*1024*1024){
    		return round($size/1024/1024,2)."M";
    	}
    	else{
    		return " ";
    	}
}
function transformTime($time){
	return date('Y-m-d H:i:s', $time);
}

function getRouteByResId($id){
    $res=model('Resource')->where('resource_id='.$id)->find();
    return $res->route;
}
function getMenuName($id){
    if($id == 0){
        return "--";
    }
    $res = model('Menu')->where('menu_id',$id)->find();
    return $res->menu_name;
}
function getRoleName($id){
    $res = model('Role')->where('role_id',$id)->find();
    return $res->role_name;
}
function getStatus($status){
    if($status==1){
        return "开启";
    }
    if($status==0){
        return "关闭";
    }
    if($status==-1){
        return "移除";
    }
}
function getProvince($id){
    $res = model('Province')->where('province_id',$id)->find();
    return $res['province_name'];
}
function getActive($nav){

    $c=\think\Request::instance()->controller();
    if($nav==$c){
        return 'active-menu ';
    }
    return '';
}

function getfileicon($type){
    //文件类型
    $doc = array("doc","docx");
    $excle = array("xlsx","xls");
    $ppt = array("ppt","pptx");
    $img = array("jpg","png","jpeg","gif","bmp");
    $video = array("mp4","avi",);
    $tar = array("zip","tar",);
    $text = array("text");
    $excute = array("exe");
    $pdf = array("pdf");
    $t = strtolower($type);
    if(in_array($t,$doc)){
        return 'fa-file-word-o';
    }
    if(in_array($t,$excle)){
        return 'fa-file-excel-o';
    }
    if(in_array($t,$ppt)){
        return 'fa-file-powerpoint-o';
    }
    if(in_array($t,$img)){
        return 'fa-file-image-o';
    }
    if(in_array($t,$video)){
        return 'fa-file-video-o';
    }
    if(in_array($t,$tar)){
        return 'fa-file-archive-o';
    }
    if(in_array($t,$text)){
        return 'fa-file-text-o';
    }
    if(in_array($t,$excute)){
        return 'fa-windows';
    }
    if(in_array($t,$pdf)){
        return 'fa-file-pdf-o';
    }
    return 'fa-file-o';


}
