$(function() {
	$("#modify").click(function(){
		$("#user_info").hide();
		$("#user_info_form").show();
	});
	
	$("#pass_submit").click(function() {
		old_pass = $("#pass input[name='old_pass']").val();
		pass = $("#pass input[name='pass']").val();
		pass_check = $("#pass input[name='pass_check']").val();
		$.post(SITE_URL + 'personal/do_setting', {
				ajax: 1,
				setting: 'pass',
				old_pass: old_pass,
				pass: pass,
				pass_check: pass_check,
		}, function(data) {
			if(data.verify == 1) {
				window.location.href = SITE_URL + 'personal/setting';
			} else {
				$("#old_pass_prompt").text(data.old_pass);
				$("#pass_prompt").text(data.pass);
				$("#pass_check_prompt").text(data.pass_check);
				return false;
			}
		}, 'json'
		);
		return false;
	});
});

function scrollDoor() {
	}
	scrollDoor.prototype = {
		sd : function(menus, divs, openClass, closeClass) {
			var _this = this;
			if(menus.length != divs.length) {
				alert("菜单层数量和内容层数量不一样!");
				return false;
			}
			for(var i = 0; i < menus.length; i++) {
				_this.$(menus[i]).value = i;
				_this.$(menus[i]).onclick = function() {
					for(var j = 0; j < menus.length; j++) {
						_this.$(menus[j]).className = closeClass;
						_this.$(divs[j]).style.display = "none";
					}
					_this.$(menus[this.value]).className = openClass;
					_this.$(divs[this.value]).style.display = "block";
				}
			}
		},
		$ : function(oid) {
			if( typeof (oid) == "string")
				return document.getElementById(oid);
			return oid;
		}
	}
	window.onload = function() {
		var SDmodel = new scrollDoor();
		SDmodel.sd(["mmm01", "mmm02", "mmm03","mmm04"], ["ccc01", "ccc02", "ccc03","ccc04"], "sd01", "sd02");
	}