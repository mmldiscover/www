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