var SCOPE={
	'login':"/index.php/index/index/login",
	'register':"/index.php/index/index/register",
	'login_success':"/",
	'user_edit' :"/index.php/index/user/update",
}
function login(){
	var data = $("#sign-in").serializeArray();
    var postData = {};
    $(data).each(function(i){
    postData[this.name] = this.value;
    });
    var url = SCOPE.login;
    $.post(url,postData,function(result){
	    if(result.status == 1){
	        window.location.href=SCOPE.login_success;
	    }
	    else if(result.status == 0 ){
	        alert(result.info);
	    }
    },"JSON");        
}

function register(){
	var data = $("#sign-up").serializeArray();
    var postData = {};
    
    $(data).each(function(i){
    	postData[this.name] = this.value;
    });
    
      var url = SCOPE.register;
	    $.post(url,postData,function(result){
		    if(result.status == 1){
		        window.location.href=SCOPE.login;
		    }
		    else if(result.status == 0 ){
		        alert(result.info);
		    }
	    },"JSON");     
}

function save(){
		var data = $("#user-info").serializeArray();
	    var postData = {};
	    $(data).each(function(i){
	    postData[this.name] = this.value;
	    });
	    var url = SCOPE.user_edit;
	    $.post(url,postData,function(result){
		    alert(result.info);
	    },"JSON");        

    }
