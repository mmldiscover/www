var post={
	/**
	 * 
	 * @param {Object} id  表单 id
	 * @param {Object} url 请求 地址
	 * @param {Object} now_url  当前目标地址
	 * @param {Object} now_id   当前目标id
	 * @param {Object} attr_id  目标 id
	 * 
	 */
	form_send:function(id,url,now_url,now_id,attr_id){
		var data = $(id).serializeArray();
	    var postData = {};
	    $(data).each(function(i){
	    postData[this.name] = this.value;
	    });
		$.post(url,postData,function(result){
		    
		    if(result.status==1){
		    	$(now_id).load(now_url+" "+attr_id);
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
	data_send:function(data,url,now_url,now_id,attr_id){
		$.post(url,data,function(result){
		    
		    if(result.status==1){
		    	$(now_id).load(now_url+" "+attr_id);
		    }
		    else{
		    	alert(result.info);
		    }
	    },"JSON");
	}
}
var com = "#content";
var page ="#page-wrapper"
//school
function school_add(){
	post.form_send("#form",SCOPE.school_add,SCOPE.school,com,page);
}
function school_update(){
	post.form_send("#form",SCOPE.school_update,SCOPE.school,com,page);
}
function school_delete(i){
	var postData = {'id':i};
	post.data_send(postData,SCOPE.school_delete,SCOPE.school,com,page);
}