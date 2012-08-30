$(function() {
        $("#login_form").submit(function() {
                email = $("input[name='email']").val();
                pass = $("input[name='pass']").val();
                remember = $("input[name='remember']").val();
                $submit = $("input[name='submit']");
                $submit.attr('disabled', 'disabled');
                $submit.val('正在登录');
                $.post(SITE_URL+"index/do_login", {
                    ajax:1,
                    email:email,
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
                        $("#email_prompt").text(data.email);
                        $("#pass_prompt").text(data.pass);
                        $submit.removeAttr('disabled');
                        $submit.val('登录');
                    }
                   }, 'json'
                );
                return false;
        });
});