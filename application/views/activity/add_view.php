<header class="subhead">
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
                    <label class="control-label">活动名称：</label>
                    <div class="controls">
                        <input type="text" name="name" class="input-xlarge" id="input01">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">活动时间：</label>
                    <div class="controls">
                        <input type="text" name="start_time" class="span2 input-xlarge" id="start">
                        至
                        <input type="text" name="deadline" class="span2 input-xlarge" id="end">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">活动地点：</label>
                    <div class="controls">
                        <input type="text" name="address" class="input-xlarge" id="input03">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">活动说明：</label>
                    <div class="controls">
                        <textarea class="input-xlarge" name="detail" id="textarea" rows="6"></textarea>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btnDefault btnBlue">提交</button>
                    <button class="btnDefault">取消</button>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript">
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
    });

</script>