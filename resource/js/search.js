$(function() {
	key_org = $("#receiver").val();
	$("#receiver").keyup(function() {
		key = $(this).val();
		// 当表单值不为空 或者值变化时才发出ajax请求
		if(key == '' || key == key_org) {
			return;
		}
		key_org = key;
		$.post(
			SITE_URL + 'search/ajax_aucomplate', {
				ajax: 1,
				obj: 'user',
				from: 'all',
				key: key
			}, function(data) {
				$("#receiver").autocomplete({
					source: data,
					minLength: 0,
				});
			}, 'json'
		)
	});
});
