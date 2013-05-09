<!--<h4 class="title_01 title_02"><a>返回社团首页</a></h4>-->
<!--<div class="main_02">-->
<!--<div id="add-corporation">-->
<!--	--><?//=form_open('activity/do_add/' . $corporation['id']) ?>
<!--		<span ><label>活动名称：</label>-->
<!--			<div class="InputWrapper"><div class="InputInner">-->
<!--				--><?//=form_input('name') ?>
<!--			</div></div>-->
<!--		</span>-->
<!--		<span ><label>活动地点：</label> <div class="InputWrapper"><div class="InputInner">--><?//=form_input('address') ?><!--</div></div></span>-->
<!--		<span ><label>活动时间：</label>-->
<!--			<div id="start">-->
<!--			<div class="InputWrapper"><div class="InputInner">-->
<!--				--><?//=form_input('start_time', '', 'id="from"') ?>
<!--			</div></div></div>-->
<!--			<div id="conn">-->
<!--			--->
<!--			</div>-->
<!--			<div id="end">-->
<!--			<div class="InputWrapper"><div class="InputInner">-->
<!--				--><?//=form_input('deadline','', 'id="to"') ?>
<!--			</div></div></div>-->
<!--		</span>-->
<!--		<span ><label>活动简介：</label>-->
<!--			<table class="Textarea">-->
<!--			<tbody>-->
<!--				<tr>-->
<!--					<td id="Textarea-tl"></td>-->
<!--					<td id="Textarea-tm"></td>-->
<!--					<td id="Textarea-tr"></td>-->
<!--				</tr>-->
<!--				<tr>-->
<!--					<td id="Textarea-ml"></td>-->
<!--					<td id="Textarea-mm" class="">-->
<!--						<div>-->
<!--							--><?//=form_textarea('comment') ?>
<!--						</div>-->
<!--					</td>-->
<!--					<td id="Textarea-mr"></td>-->
<!--				</tr>-->
<!--				<tr>-->
<!--					<td id="Textarea-bl"></td>-->
<!--					<td id="Textarea-bm"></td>-->
<!--					<td id="Textarea-br"></td>-->
<!--				</tr>-->
<!--			</tbody>-->
<!--			</table>-->
<!--		</span>-->
<!--		<p class="li_d">--><?//=form_submit('submit', '保存','class="pub_button"') ?><!--</p>-->
<!--	--><?//=form_close() ?>
<!--	<script type="text/javascript">-->
<!--	$(function() {-->
<!--    	var dates = $( "#from, #to" ).datepicker({  -->
<!--        defaultDate: "+1w",  -->
<!--        changeMonth: true,  -->
<!--        numberOfMonths: 1,-->
<!--        altFormat: "yy-mm-dd",-->
<!--        onSelect: function( selectedDate ) {  -->
<!--            var option = this.id == "from" ? "minDate" : "maxDate",  -->
<!--                instance = $( this ).data( "datepicker" ),  -->
<!--                date = $.datepicker.parseDate(  -->
<!--                    instance.settings.dateFormat ||  -->
<!--                    $.datepicker._defaults.dateFormat,  -->
<!--                    selectedDate, instance.settings );  -->
<!--            dates.not( this ).datepicker( "option", option, date );-->
<!--        	}  -->
<!--    	});  -->
<!--	});  -->
<!--	</script>-->
<!--</div>	-->
<!--</div>  -->

<header class="subhead">
    <div class="container">
    </div>
</header>
<div class="container mainBody">
    <div class="mt20 feed_switcher">
        <span class="f20">创建活动</span>
        <div class="feed_op">
            <a href="activityhome.html">返回活动之家</a>
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

        <form class="form-horizontal hi/de" >
            <fieldset>
                <legend>创建活动</legend>
                <div class="control-group">
                    <label class="control-label">活动名称：</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="input01">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">活动时间：</label>
                    <div class="controls">
                        <input type="text" class="span2 input-xlarge" id="start">
                        至
                        <input type="text" class="span2 input-xlarge" id="end">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">活动地点：</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="input03">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">活动说明：</label>
                    <div class="controls">
                        <textarea class="input-xlarge" id="textarea" rows="6"></textarea>
                    </div>
                </div>
                <div class="control-group swf_wrap_i">
                    <label  class="control-label">活动宣传图：</label>
                    <div class="controls">
                        <input id="file_name_mask" type="text" class="fl" value="">
                        <div class="uploadInput fl">
                            <a class="btnDefault" href="javascript:;">
                                浏览<q><input id="file_name" name="Filedata" contenteditable="false" type="file"></q>
                            </a>
                        </div>
                        <a href="#" class="btnDefault" id="link_upload">保存</a>
                        <p class="help-block">请选择jpg、gif格式，且文件大小不超过2M的图片</p>
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