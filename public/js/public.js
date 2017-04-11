
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



			var f = true;
			var str_1 = "<span class=\"glyphicon glyphicon-upload\"></span> 上传文件"
			var str_2 = "<span class=\"glyphicon glyphicon-home\"></span> 返回网盘"

			function mytab(i) {
				if(f) {
					$(i).html(str_2);
					$('.mytable').fadeToggle(300);
					$('.myform').delay(200).fadeToggle(200);
					f = false;

				} else {
					$(i).html(str_1);
					$('.myform').fadeToggle(300);
					$('.mytable').delay(200).fadeToggle(200);
					f = true;
					location.reload();

				}

			}

			function deletefolder(id) {
				url = "/index.php/index/folder/delete";
				var postData = {};
				postData['id'] = id;
				$.post(url, postData, function(result) {
					if(result.status == 1) {
						$("#content").load(SCOPE.rsmanager+" #page-wrapper");
					}
				}, "JSON");
			}

			function newfolder(id) {
				var str = "<tr><td><input type=\"checkbox\"/> </td><td><span class=\"glyphicon glyphicon-folder-open\" style=\"float: left;padding-right: 10px;margin-top: 10px;\"></span><input class=\"form-control newfolder\" style=\"width:50%;\" value=\"新建文件夹\"/></td><td>--</td><td>--</td><td></td></tr>";
				//		$('.mytable').before(str);
				$('#newfolder').show();
				$('.newfolder').value = "新建文件夹";
				$('.newfolder').focus();
				$('.newfolder').select();
			}
			function folder_add(i,id) {
				url = "/index.php/index/folder/add";
				var postData = {};
				postData['id'] = id;
				postData['name'] = $(i).val();

				$.post(url, postData, function(result) {

					if(result.status == 1) {
						$("#content").load(SCOPE.rsmanager+" #page-wrapper");
					} else {
						alert(result.info);
					}
				}, "JSON");
			}
	
