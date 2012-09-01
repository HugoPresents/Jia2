function request_letter(box) {
	$.post(SITE_URL + 'notify?type=letter', {
		ajax: 1,
		box: box
	}, function(data) {
		$("#letter_" + box + "_content").remove();
		$("#letter_box").prepend(data);
	});
}
$(function() {
	$("#write_letter").click(function() {
		$("#write_letter_area").toggle();
		if($("#write_letter_area").is(":hidden")) {
			$(this).text('写站内信');
		} else {
			$(this).text('取消');
		}
	});
	
	$("#send_letter").click(function() {
		receiver = Number($("#receiver_id").val());
		if(receiver < 1) {
			$('.letter_message').html('请选择收信人');
			$('.letter_message').fadeIn('slow', function() {
			    $('.letter_message').fadeOut('slow');
			});
			return false;
		}
		content = $("#letter_content").val();
		$("send_letter").attr('disabled', 'disabled');
		$.post(SITE_URL + 'notify/letter', {
			ajax: 1,
			receiver: receiver,
			content: content
		}, function(data) {
			if(data.success == 1) {
				$("#receiver").val('');
				$("#letter_content").val('');
				$('#write_letter').trigger('click');
				$('.letter_message').html('发送成功！');
				$('.letter_message').fadeIn('slow', function() {
			        $('.letter_message').fadeOut('slow');
			    });
			    $("send_letter").removeAttr('disabled');
			} else {
				$('.letter_message').html(data.message);
				$('.letter_message').fadeIn('slow', function() {
			        $('.letter_message').fadeOut('slow');
			    });
			    $("send_letter").removeAttr('disabled');
			}
		}, 'json');
	});

	// 默认请求收件箱
	request_letter('in');
	
	$("#in_box").click(function() {
		$("#letter_out_content").hide();
		if($("#letter_in_content").length > 0) {
			$("#letter_in_content").show();
			return false;
		} else {
			request_letter('in');
		}		
	});
	$("#out_box").click(function() {
		$("#letter_in_content").hide();
		if($("#letter_out_content").length > 0) {
			$("#letter_out_content").show();
			return false;
		} else {
			request_letter('out');
		}
	});
	
	// 点开收信人时判断是否ajax请求好友列表
	$("#check_linkman, #linkman0").click(function() {
		if($("#popup4").is(":visible") == true) {
			$("#linkmanlist0, #pagination0").show();
			$("#linkmanlist1, #pagination1").hide();
			if($("#linkmanlist0 li").length == 0) {
				fetch_user('0', 1);
			}
		}
		return true;
	});
	
	linkman_tab();
	
	$("#popup4 li.group ").live("click",function(){
		$("#receiver_id").val($(this).attr("user_id"));
		$("#receiver").empty();
		var linkmans="";
		linkman=$(this).find("span").text();
		
		$("#receiver").append($('<span class="linkman_tag">' + linkman + '<i class="del_linkman"> × </i> </span>'));
		$('#fade , .popup_block').fadeOut(function() {
			$('#fade, a.close').remove(); 
		});
		return false;
	});
	
	$("#linkman1").live("click", function() {
		$("#linkmanlist1, #pagination1").show();
		$("#linkmanlist0, #pagination0").hide();
		if($("#linkmanlist1 li").length == 0) {
			fetch_user('1', 1);
		}
	});
	
	$("#pagination0 a").live("click", function() {
		page = $(this).attr('href');
		// 取得点击的页码
		page = page.substring(2);
		fetch_user('0', page);
		return false;
	});
	
	$("#pagination1 a").live("click", function() {
		page = $(this).attr('href');
		// 取得点击的页码
		page = page.substring(2);
		fetch_user('1', page);
		return false;
	});
	
	$(".del_linkman").live("click",function(){
		$(this).parent().remove();
		$("#receiver_id").val(0);
	});
});

function fetch_user(target, page) {
	$("#linkmanlist" + target).empty();
	$("#linkmanlist" + target).append('<p class="loading_user"><img src="/resource/img/loading.gif"></img><p>');
	$("#linkmanlist" + target).empty();
	relation = 'following';
	if(target == '1') {
		relation = 'follower';
	}
	$.post(SITE_URL + 'search/user_relation', {
		ajax: 1,
		relation: relation,
		page: page
	}, function(data) {
		if(data.success == '1') {
			$("p.loading_user").remove();
			$("#linkmanlist" + target).append(data.content);
			$("#pagination" + target).empty().append(data.pagination);
		}
	}, 'json')
}
