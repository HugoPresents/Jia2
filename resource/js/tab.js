/**
 * @author Tiramisu
 */

function scrollDoor() {
}

scrollDoor.prototype = {
	sd : function(menus, divs, openClass, closeClass) {
		var _this = this;
		
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
function posttab(){
		var SDmodel = new scrollDoor();
		SDmodel.sd(["po1", "po2"], ["feed_1", "feed_2"], "sd01", "sd02");
		}//post
function setingtab(){
	var SDmodel = new scrollDoor();
	SDmodel.sd(["s01", "s02", "s03","s04"], ["c01", "c02", "c03","c04"], "sd01", "sd02");//设置页面
}
function searchtab(){
	var SDmodel = new scrollDoor();
	SDmodel.sd(["01", "02", "03", "04"], ["search_result_01", "search_result_02", "search_result_03", "search_result_04"], "sd01", "sd02");//搜索
}

function cotab(){
	var SDmodel = new scrollDoor();
	SDmodel.sd(["co-1", "co-2"], ["feed_1", "feed_2"], "sd01", "sd02");//我的社团
}
function coprotab(){
	var SDmodel = new scrollDoor();
	SDmodel.sd(["co-01", "co-02", "co-03"], ["co_01", "co_02", "co_03"], "sd01", "sd02");//社团主页
}
function copro_m_tab(){
	var SDmodel = new scrollDoor();
	SDmodel.sd(["coo-01", "coo-02", "coo-03"], ["coo_01", "coo_02", "coo_03"], "sd01", "sd02");//社团设置
}
