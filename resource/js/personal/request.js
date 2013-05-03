$(function() {
	$("a.reject_request").click(function() {
		request_id = $(this).attr('request_id');
		$.post(
			SITE_URL + 'personal/reject_request',
			{
				ajax: 1,
				request_id :request_id
			}, function(data) {
				if(data.success == 1) {
					location.reload();
				} else {
					alert(data.message);
				}
			}, 'json'
		);
		return false;
	});
});
