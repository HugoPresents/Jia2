$(function() {
	$("#userfile").change(function() {
		path = $(this).val();
		if(path.length < 1) {
			$("#filename").html('未选择文件');
			return;
		}
		fileName = path.substring(path.lastIndexOf('\\')+1,path.lastIndexOf('.'));
		$("#filename").html(fileName);
	});
	$("#upload_avatar").click(function() {
		if($("#userfile").val().length < 1) {
			$("#filename").fadeOut('fast', function() {
				$("#filename").css('backgroundColor', 'yellow');
				$("#filename").fadeIn('slow', function() {
					$("#filename").css('backgroundColor', '');
				});
			});
			return false;
		}
	});
	$("#modify").click(function(){
		$("#user_info").hide();
		$("#user_info_form").show();
	});
	
	$("#pass_submit").click(function() {
		old_pass = $("#set_pass input[name='old_pass']").val();
		pass = $("#set_pass input[name='pass']").val();
		pass_check = $("#set_pass input[name='pass_check']").val();
		$.post(SITE_URL + 'personal/do_setting', {
				ajax: 1,
				setting: 'pass',
				old_pass: old_pass,
				pass: pass,
				pass_check: pass_check,
		}, function(data) {
			if(data.verify == 1) {
				window.location.href = SITE_URL + 'personal/setting';
			} else {
				$("#old_pass_prompt").text(data.old_pass);
				$("#pass_prompt").text(data.pass);
				$("#pass_check_prompt").text(data.pass_check);
				return false;
			}
		}, 'json'
		);
		return false;
	});
});
