$(function() {
	// 移除成员
	$("button[name='remove_member']").click(function() {
		member_id = $(this).attr('member_id');
		$button = $(this);
		$li = $button.parent().parent().parent().parent('li');
		$.post(SITE_URL + 'corporation/delete_member', {
			ajax:1,
			co_id: CO_ID,
			member_id:member_id
		}, function(data) {
			if(data == '1') {
				$button.attr('disabled', 'disabled');
				$li.fadeOut("slow", function() {
					$li.remove();
				});
			}
		});
	});
});
