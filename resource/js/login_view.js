$(function() {
	$name = $("#name");
    $pass = $("#pass"); 
    $submit = $("input[name='submit']");  
    
function name_check() {
    var val = $("#name").val();
    if (val == '') {
        $("#name_prompt").text('用户名不能为空').fadeIn();
        return false;
    } else if (val !== '') {
        $("#name_prompt").text('').addClass("ok").fadeIn();
        $submit.attr("disabled",false);
        return true;
    }
}

function pass_check() {
    val = $("#pass").val();
    len =  val.length;
    if (val == '') {
        $("#pass_prompt").text('密码不能为空').fadeIn();
        return false;
    }else if(len < 4){
    	$("#pass_prompt").addClass("alert-error").text('密码不能小于4位数').fadeIn();
    	return false;
    } else if (val !== '') {
        $("#pass_prompt").text('').addClass("ok").fadeIn();
        return true;
    }
}
$name.blur(function () {
        name_check();
    });
$pass.blur(function () {
        pass_check();
    });

        $("#login_form").submit(function() {
        	name = $name.val();
        	pass = $pass.val();
        	remember = $("#remember").val();
    		
                $submit.attr('disabled', 'disabled');
                $submit.val('正在登录');
                $.post(SITE_URL+"index/do_login", {
                    ajax:1,
                    email:name,
                    pass:pass,
                    remember:remember
                }, function(data) {
                    if(data.verify == 1) {
                    	$submit.val('登录成功');
                    	href = window.location.href;
                    	if(href.indexOf("?jump=") > 0) {
                    		window.location.href = SITE_URL + href.substr(href.indexOf("?jump=") + 6);
                    	} else {
                    		window.location.href = SITE_URL;
                    	}
                    } else {
                        if(data.email) {
                            $("#name_prompt").text(data.email).show();
                            $("#pass_prompt").hide();
                        }
                        if(data.pass) {
                            $("#pass_prompt").text(data.pass).show();
                            $("#name_prompt").hide();
                        }
                        $submit.removeAttr('disabled');
                        $submit.val('登录');
                    }
                   }, 'json'
                );
                return false;
        });
});