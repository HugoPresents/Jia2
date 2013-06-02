<header class="subhead subheadline">
    <div class="container">
    </div>
</header>
<div class="container mainBody">
    <div class="mt20 feed_switcher">
        <span class="f20">创建活动</span>
        <div class="feed_op">
            <a href="/corporation/profile/<?=$corporation['id']?>">返回社团主页</a>
        </div>
    </div>
    <div class="main_02">
        <form class="form-horizontal" method="post" action="/activity/do_add/<?=$corporation['id']?>">
            <fieldset>
                <div class="control-group">
                    <label class="control-label"><em>* </em>活动名称：</label>
                    <div class="controls">
                        <input type="text" name="name" class="input-xlarge" id="input01">
                        <span class="alert alert-error" id="">请输入活动名称</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><em>* </em>活动时间：</label>
                    <div class="controls">
                        <input type="text" name="start_time" class="span2" id="start">
                        至
                        <input type="text" name="deadline" class="span2" id="end">
                        <span class="alert alert-error" id="">请输入活动时间</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><em>* </em>活动地点：</label>
                    <div class="controls">
                        <input type="text" name="address" class="input-xlarge" id="input03">
                        <span class="alert alert-error" id="">请输入活动地点</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><em>* </em>活动说明：</label>
                    <div class="controls">
                        <textarea class="input-xlarge" name="detail" id="textarea" rows="6"></textarea>
                        <span class="alert alert-error" id="" style="vertical-align: top">请输入活动说明</span>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" id="submit" class="btnDefault btnBlue">提交</button>
                    <button class="btnDefault">取消</button>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript">
var $submit = $("#submit");
    $(function(){
    	
        $( "#start" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            onClose: function( selectedDate ) {
                $( "#end" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $( "#end" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            onClose: function( selectedDate ) {
                $( "#start" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
        $(".input-xlarge").blur(function(){
			null_check($(this));
		});		
    });
function null_check(obj) {
		    var val = obj.val();
		    if (val == '') {
		        obj.next().fadeIn();
		        $submit.addClass("disabled").attr("disabled",true);
		        return false;
		    } else if (val !== '') {
		        obj.next().fadeOut();
		        $submit.removeClass("disabled").removeAttr("disabled");
		        return true;
		    }
		}
</script>