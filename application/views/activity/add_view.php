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
        <div id="request_comment">
            <p>申请细则：</p>
            <p>1. 申请创建社团需要通过实名认证，需要填写学生信息以及公民身份信息，你填写的身份信息最好和当前账号信息保持一致(姓名)</p>
            <p>2. 上传身份证以及学生证照，请确保字迹可辨认，以便管理员审核通过</p>
            <p>3. 申请创建的社团名将不可更改</p>
            <p>4. 如果审核通过，你会收到一条通知将指引你创建该社团, 并且改社团的省份以及学校信息与你的一直，不可更改</p>
            <p>5. 管理员审核之后无论通过与否你都将会收到一条通知</p>
            <p><button name="roger_that" type="button" id="roger_that" class="btnDefault">明白</button></p>
        </div>

        <form class="form-horizontal hide" method="post" action="/activity/do_add/<?=$corporation['id']?>">
            <fieldset>
                <legend>创建活动</legend>
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
        $(".btnDefault").on("click",function(){
            $(".form-horizontal").show();
        })
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