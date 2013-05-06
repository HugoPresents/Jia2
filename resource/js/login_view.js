$(function() {
//    $("#email").blur(function(){
//       if($(this).val() == ''){
//           $("#email_prompt").show();
//       }else{
//           $("#email_prompt").hide();
//       }
//    });
//    $("#Password").blur(function(){
//        if($(this).val() == ''){
//            $("#pass_prompt").show();
//        }else{
//            $("#pass_prompt").hide();
//        }
//    });

        $("#login_form").submit(function() {
        	//alert('here');
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
                        if(data.email) {
                            $("#email_prompt").text(data.email).show();
                        }
                        if(data.pass) {
                            $("#pass_prompt").text(data.pass).show();
                        }
                        $submit.removeAttr('disabled');
                        $submit.val('登录');
                    }
                   }, 'json'
                );
                return false;
        });
});