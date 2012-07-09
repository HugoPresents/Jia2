
//下拉菜单
$(function(){
	$(".setting>ul").hide();
	$(".setting").hover(function(){
			$("ul",this).slideDown("fast");
		},function(){
			$("ul",this).slideUp("fast");
	});
	$("#nav_search_submit").attr('disabled', 'disabled');
	$("#nav_search_content").keyup(function() {
		if($(this).val != '') {
			$("#nav_search_submit").removeAttr('disabled');
		}
	});
	$("#in_search").attr('disabled', 'disabled');
	$("#in_search_content").keyup(function() {
		if($(this).val != '') {
			$("#in_search").removeAttr('disabled');
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
