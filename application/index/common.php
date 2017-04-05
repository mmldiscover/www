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
