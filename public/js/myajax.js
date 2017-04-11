
var mml={
	menu_ajax:function(i){
		var url =i.getAttribute("attr-url");
		$("#content").load(url+" #page-wrapper");			
		$("#main-menu a").each(function(){
			this.setAttribute("class","waves-effect waves-dark");
		});
		i.setAttribute("class",'active-menu waves-effect waves-dark');
	},
	jump_ajax:function(i){
		var url =i.getAttribute("attr-url");
		$("#content").load(url+" #page-wrapper");
		
	},
	href_ajax:function(url){
		$("#content").load(url+" #page-wrapper");
	}
}


