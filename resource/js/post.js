/**
 * ajax 发帖以及添加评论的js
 */
$(function() {
    $('.f_summary .CommetBtn').live('click', function() {
    	 $(this).closest(".f_summary").siblings(".repeat").slideToggle("fast");
    });
	$("textarea[name='comment_content']").keyup(function() {
		$button = $(this).parent().next().children('button');
		if($(this).val() != '') {
			$button.removeAttr('disabled');
		} else {
			$button.attr('disabled', 'disabled');
		}
	});
	$("button[name='comment']").live("click",function(){
		var comment = $(this).closest(".comment_wrap").find("textarea");
		var button = $(this);
		var content = comment.val();
		var post_id = comment.attr('post_id');
		var type = comment.attr('type');
		$.post(
			SITE_URL + "post/comment", {
				ajax:1,
				content: content,
				post_id: post_id,
				type: type
			}, function(data) {
				if(data == "0") {
					alert('由于对方隐私设置，你不能评论~');
				} else {
					comment.val('');
					button.closest(".comment_wrap").next().prepend(data);
					var comments_total = comment.parents('.feed_a:first').find('span.comments_total');
					var comments = Number(comments_total.text());
					comments += 1;
					comments_total.text(comments);
				}
			}
		);
	});
	function check_content() {
	    if($("textarea[name='post_content']").val() != '') {
            return true;
        }
        return false;
	}
	$("button[name='post']").click(function() {
		var button = $(this);
		if(!check_content()) {
		    return false;
		}
		var textarea = $("#post_content")
		$.post(SITE_URL + "post/add", {
			ajax: 1,
			content: textarea.val()
		}, function(data) {
			if(data == '0') {
				alert('发表失败');
			} else {
				textarea.val('');
				$("#feed_f").prepend(data);
			}
		}
		);
	});	
	$("button[name='request_more']").click(function() {
		$button = $(this);
		$button.prev().show();
		$button.attr('disabled', 'disabled');
		page = Number($(this).attr('page'));
		type = $(this).attr('po_type');
		$.post(
			SITE_URL + 'index/ajax_trends', {
				ajax: 1,
				page: page + 1,
				type: type
			}, function(data) {
				if(data != "0") {
					$button.attr('page', page+1);
					$button.prev().hide();
					$button.prev().before(data);
					$button.removeAttr('disabled');
				} else {
					$button.attr('disabled', 'disabled');
					$button.prev().hide();
					$button.text('没有更多了亲~');
				}
			}
		);
	});
});