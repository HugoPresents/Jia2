$(function() {
	// 检测未读通知方法
	$.post(SITE_URL + 'notify/check', {
		ajax: 1
	}, function(data) {
		$("#letter_notify").append('(' + data.letter + ')');
		$("#request_notify").append('(' + data.request + ')');
		$("#message_notify").append('(' + data.message + ')');
	}, 'json'
	);
	
	// 通知页面样式
	if(typeof NOTIFY_NOW != 'undefined' ) {
		$("#notify_" + NOTIFY_NOW).children("a").attr('id', 'active');
	}
});