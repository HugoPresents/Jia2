$(function () {
    regist =  $("#regist");
    $("#email").blur(function () {
        email_check();
    });
    $("#name").blur(function () {
        name_check();
    });
    $("#pass").blur(function () {
        pass_check();
    });

    $("#regist").click(function () {
        $submit = $(this);
        $(this).attr('disabled', 'disabled');
        $(this).val('正在注册');
        if (email_check() && name_check() && pass_check()) {
            email = $("#email").val();
            name = $("#name").val();
            pass = $("#pass").val();
            $.post(SITE_URL + "index/do_regist", {
                    ajax: 1,
                    email: email,
                    name: name,
                    pass: pass
                }, function (data) {
                    if (data.verify == 1) {
                        $submit.val('注册成功');
                        window.location.href = SITE_URL;
                    } else {
                        if(data.email) {
                            $("#email_prompt").text(data.email);
                            $("#email_prompt").show();
                        }
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
    var val = $("#name").val();
    if (val == '') {
        $("#name_prompt").removeClass("ok").text('用户名不能为空').fadeIn();
        regist.attr("disabled","true");
        return false;
    } else if (val !== '') {
        $("#name_prompt").text('').addClass("ok").fadeIn();
        regist.attr("disabled",false);
        return true;
    }
}

function pass_check() {
    val = $("#pass").val();
    len =  val.length;
    if (val == '') {
        $("#pass_prompt").removeClass("ok").text('密码不能为空').fadeIn();
        regist.attr("disabled","true");
        return false;
    }else if(len < 4){
    	$("#pass_prompt").addClass("alert-error").text('密码不能小于4位数').fadeIn();
    	regist.attr("disabled","true");
    } else if (val !== '') {
        $("#pass_prompt").text('').addClass("ok").fadeIn();
        regist.attr("disabled",false);
        return true;
    }
}

function email_check() {
    val = $("#email").val();
    var myreg = /\w+((-w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+/;
    if (val == '') {
        $("#email_prompt").removeClass("ok").text('邮箱不能为空').fadeIn();
        regist.attr("disabled","true");
        return false;
    } else if (!myreg.test(val)) {
        $("#email_prompt").addClass("alert-error").text('邮箱格式不正确').fadeIn();
        regist.attr("disabled","true");
        return false;
    } else if (myreg.test(val)) {
        $("#email_prompt").text('').removeClass("alert-error").addClass("ok").fadeIn();
        regist.attr("disabled",false);
        return true;
    }
}
