
//下拉菜单
$(function(){
	$(".setting>ul").hide();
	$(".setting").hover(function(){
			$("ul",this).slideDown("fast");
		},function(){
			$("ul",this).slideUp("fast");
	});
	$("#nav_search_submit").click(function() {
		if($("#nav_search_content").val() == '') {
			return false;
		}
	});
	$("#in_search").click(function() {
		if($("#in_search_content").val() == '') {
			return false;
		}
	});
	
	// 输入框
	$(".InputWrapper").hover(function(){
		 $(this).addClass("InputWrapper_hover");
	});
	$(".InputWrapper").focus(function(){
		 $(this).addClass("InputWrapper_focus");
	});
	$(".Textarea").hover(function(){
		 $(this).addClass("Textarea-hover");
	});
	$(".Textarea").focus(function(){
		 $(this).addClass("Textarea-focus");
	});
	
	//搜索框
	$("#nav_search_content").focus(function(){
		$(this).val("");
	})
});

function index_user(extend) {
	$.post(
		SITE_UTL + 'search/user_json',
		{
			extent: extend,
		}, function(data) {
			$("#search_input")
		}, 'json'
	);
}
