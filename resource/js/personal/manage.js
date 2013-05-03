$(function() {
	// 取消关注
	$("button[name='unfollow']").click(function() {
		user_id = $(this).attr('user_id');
		$button = $(this);
		$li = $button.parent().parent('li');
		$.post(SITE_URL + 'personal/unfollow', {
			ajax:1,
			user_id:user_id
		}, function(data) {
			if(data == '1') {
				$button.attr('disabled', 'disabled');
				$li.fadeOut("slow", function() {
					$li.remove();
				});
			}
		}
		);
	});
	
	// 移除粉丝
	$("button[name='remove_follower']").click(function() {
		user_id = $(this).attr('user_id');
		$button = $(this);
		$li = $button.parent().parent('li');
		$.post(SITE_URL + 'personal/remove_follower', {
			ajax:1,
			user_id:user_id
		}, function(data) {
			if(data == '1') {
				$button.attr('disabled', 'disabled');
				$li.fadeOut("slow", function() {
					$li.remove();
				});
			}
		}
		);
	});
});
