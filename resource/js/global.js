
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
	$("#in_search_form").submit(function() {
		if($("#in_search_content").val() == '') {
			return false;
		}
		if($("#check_user").attr('checked') != 'checked' && $("#check_corporation").attr('checked') != 'checked' && $("#check_activity").attr('checked') != 'checked') {
			$("#chose_box").css('background-color', 'yellow');
			setTimeout()
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

// 显示提示信息方法
function show_message(target, message) {
	$(target).html(message);
	$(target).fadeIn('slow', function() {
        $(target).fadeOut('1000');
    });
}