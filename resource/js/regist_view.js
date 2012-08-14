$(function() {
	$("#email").blur(function(){
		email_check();
	});
	$("#name").blur(function(){
		name_check();
	});
	$("#pass").blur(function(){
		pass_check();
	});
	
	$("input[name='submit']").click(function() {
		$submit = $(this);
		$(this).attr('disabled', 'disabled');
		$(this).val('正在注册');
		if(email_check() && name_check() && pass_check()) {
			email = $("#email").val();
			name = $("#name").val();
			pass = $("#pass").val();
			$.post(SITE_URL+"index/do_regist", {
				ajax:1,
				email:email,
				name: name,
				pass: pass
			}, function(data) {
					if(data.verify == 1) {
						$submit.val('注册成功');
						window.location.href = SITE_URL;
					} else {
						$("#email_prompt").text(data.email);
						$submit.val('注册');
						$submit.removeAttr('disabled');
						return false;
					}
				}, 'json'
			);
			$submit.val('注册');
			$submit.removeAttr('disabled');
			return false;
		} else {
			$submit.val('注册');
			$submit.removeAttr('disabled');
			return false;
		}
	});	
});

function name_check() {
	val = $("#name").val();
	if(val==''){
			$("#name_prompt").text('姓名不能为空');
			return false;
		}else if(val!==''){
			$("#name_prompt").text('姓名正确');
			return true;
		}
}

function pass_check() {
	val = $("#pass").val();
	if(val=='') {
		$("#pass_prompt").text('密码不能为空');
		return false;
	} else if(val!=='') {
		$("#pass_prompt").text('');
		return true;
	}
}

function email_check() {
	val = $("#email").val();
	var myreg = /\w+((-w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+/;	
		if(val=='') {
			$("#email_prompt").text('邮箱不能为空');
			return false;
		} else if(!myreg.test(val)) {
			$("#email_prompt").text('邮箱格式不正确');
			return false;
		} else if(myreg.test(val)) {
			$("#email_prompt").text('邮箱格式正确');
			return true;
		}
}
