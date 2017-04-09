var SCOPE={
	'login':"/index.php/index/index/login",
	'register':"/index.php/index/index/register",
	'login_success':"/",
	'user_edit' :"/index.php/index/user/update",
	'menu_add' :"/index.php/index/menu/add",
	'menu_update' :"/index.php/index/menu/update",
	'school_add' :"/index.php/index/school/add",
	'school_update' :"/index.php/index/school/update",
	'school_delete' :"/index.php/index/school/delete",
	'school' :"/index.php/index/school",
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
function menu_add(){
	var data = $("#menu").serializeArray();
	    var postData = {};
	    $(data).each(function(i){
	    postData[this.name] = this.value;
	    });
	    var url = SCOPE.menu_add;
	    $.post(url,postData,function(result){
		    if(result.status==1){
		    	window.location.href="/index.php/index/menu"
		    }
		    else{
		    	alert(result.info);
		    }
	    },"JSON");
}
function menu_update(){
	var data = $("#menu").serializeArray();
	    var postData = {};
	    $(data).each(function(i){
	    postData[this.name] = this.value;
	    });
	    var url = SCOPE.menu_update;
	    $.post(url,postData,function(result){
		    if(result.status==1){
		    	window.location.href="/index.php/index/menu"
		    }
		    else{
		    	alert(result.info);
		    }
	    },"JSON");
}
function deletemenu(id){
		url="/index.php/index/menu/delete";
		var postData = {};
		postData['id'] = id;
		$.post(url,postData,function(result){
		    alert(result.info);
		    if(result.status==1){
		    	location.reload();
		    }
	    },"JSON");
}
function jump(i){
			var url = i.getAttribute("attr-url")
			window.location.href=url;
}


var send={
	jump_send:function(id,url,jump){
		var data = $(id).serializeArray();
	    var postData = {};
	    $(data).each(function(i){
	    postData[this.name] = this.value;
	    });
		$.post(url,postData,function(result){
		    
		    if(result.status==1){
		    	window.location.href=jump;
		    }
		    else{
		    	alert(result.info);
		    }
	    },"JSON");
	},
	reload_send:function(id,url){
		var data = $(id).serializeArray();
	    var postData = {};
	    $(data).each(function(i){
	    postData[this.name] = this.value;
	    });
		$.post(url,postData,function(result){
		    
		    if(result.status==1){
		    	window.location.href=jump;
		    }
		    else{
		    	alert(result.info);
		    }
	    },"JSON");
	},
	reload_data_send:function(data,url){
		$.post(url,data,function(result){
		    
		    if(result.status==1){
		    	location.reload();
		    }
		    else{
		    	alert(result.info);
		    }
	    },"JSON");
	}
}

function school_add(){
	send.jump_send("#form",SCOPE.school_add,SCOPE.school);
}
function school_update(){
	send.jump_send("#form",SCOPE.school_update,SCOPE.school);
}
function school_delete(i){
	var postData = {'id':i};
	send.reload_data_send(postData,SCOPE.school_delete);
}
