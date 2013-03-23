/**
 * ajax 发帖以及添加评论的js
 */
$(function() {
	$(".col-c").click(function() {
		$comments = $(this).parent().parent().parent().next();
		$comments.slideToggle();
		if($(this).text() == '展开评论') {
			$(this).text('收起评论');
		} else {
			$(this).text('展开评论');
		}
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
		$comment = $(this).parent().parent().find("textarea");
		$button = $(this);
		content = $comment.val();
		post_id = $comment.attr('post_id');
		type = $comment.attr('type');
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
					$comment.val('');
					$button.parent().parent().prev().prev().append(data);
				}
			}
		);
	})
	$("textarea[name='post_content']").live("keyup",function() {
		if($(this).val() != '') {
			$("button[name='post']").removeAttr('disabled');
		} else {
			$("button[name='post']").attr('disabled', 'disabled');
		}
	})
	
	$("button[name='post']").click(function() {
		var button = $(this);
		var textarea = $("#post_content")
		$.post(SITE_URL + "post/add", {
			ajax: 1,
			content: textarea.val()
		}, function(data) {
			if(data == '0') {
				alert('发表失败');
			} else {
				textarea.val('');
				$("#feed_1").prepend(data);
				button.attr('disabled', 'disabled');
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