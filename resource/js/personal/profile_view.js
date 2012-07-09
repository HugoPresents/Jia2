$(function() {
	// 关注某人
	$("button[name='follow']").click(function() {
		user_id = $(this).attr('user_id');
		$.post(SITE_URL + 'personal/follow', {
			ajax: 1,
			user_id: user_id
		}, function(data) {
			if(data == 1) {
				$("button[name='follow']").attr('disabled', 'disabled');
				$("button[name='follow']").text('已关注');
			} else {
				alert('由于对方的隐私设置关注失败');
			}
			}
		);
		return false;
	});
	// 取消关注
	$("button[name='unfollow']").click(function() {
		user_id = $(this).attr('user_id');
		$.post(SITE_URL + 'personal/unfollow', {
			ajax: 1,
			user_id: user_id
		}, function(data) {
			if(data == 1) {
				$("button[name='unfollow']").remove();
				$("button[name='follow']").removeAttr('disabled');
				$("button[name='follow']").text('关注')
			} else {
				alert('取消关注失败');
			}
			}
		);
		return false;
	});
});
