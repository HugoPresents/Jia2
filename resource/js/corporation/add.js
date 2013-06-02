$(function() {
	$("input[name='user_id']").keydown(function() {
		
	});
	
	$("#roger_that").click(function() {
//		$("#request_comment").hide();
		$(".form-horizontal").show();
	});
	var $submit = $("#submit");

$("input[type=text]").blur(function(){
	null_check($(this));
});	
function null_check(obj) {
    var val = obj.val();
    if (val == '') {
        obj.next().fadeIn();
        $submit.addClass("disabled").attr("disabled",true);
        return false;
    } else if (val !== '') {
        obj.next().fadeOut();
        $submit.removeClass("disabled").removeAttr("disabled");
        return true;
    }
}
	var validator = $("#request_form").validate({
            rules: {
                st_card_number: "required",
                st_card_cap: "required",
                id_card_number: "required",
                id_card_cap: "required",
                co_name: "required",
            },
            messages: {
                st_card_number: "请输入学号",
                st_card_cap: "请选择学生证",
                id_card_number: "请输入身份证号",
                id_card_cap: "请选择身份证",
                co_name: "请输入社团名",
            },

            errorPlacement: function(error, element) {
                error.appendTo( element.parent().next() );
            },

            success: function(label) {
                label.html("&nbsp;").addClass("checked");
            }
        });
});