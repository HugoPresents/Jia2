<?
/*
<script type="text/javascript" src="<?=base_url('resource/SwfUpload/js/swfupload/swfupload.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('resource/SwfUpload/js/swfupload/handlers.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('resource/SwfUpload/js/swfupload/fileprogress.js') ?>"></script>
<script>
		window.onload = function() {
				swfu1 = new SWFUpload({
		            // Backend Settings
		            upload_url: "<?=site_url('corporation/upload_cap') ?>",
		            post_params: {"PHPSESSID": "<?=session_id() ?>", 'field':'st_card_cap', 'user':'<?=$this->session->userdata('id') ?>'},
		
		            // File Upload Settings
		            file_size_limit : "2 MB",	// 2MB
		            file_types : "*.jpg;*.png;*.gif;*.jpeg",
		            file_types_description : "JPG Images",
		            file_upload_limit : "1",
		            file_post_name: "st_card_cap",
		
		            // Event Handler Settings - these functions as defined in Handlers.js
		            //  The handlers are not part of SWFUpload but are part of my website and control how
		            //  my website reacts to the SWFUpload events.
		            file_queued_handler : fileQueued,
		            file_queue_error_handler : fileQueueError,
		            file_dialog_complete_handler : fileDialogComplete,
		            upload_progress_handler : uploadProgress,
		            upload_error_handler : uploadError,
		            upload_success_handler : uploadSuccess,
		            upload_complete_handler : uploadComplete,
		
		            // Button Settings
		            button_image_url : "<?=base_url('resource/img/swf_btn.png') ?>",
		            button_placeholder_id : "spanButtonPlaceholder1",
		            button_width: 200,
		            button_height: 31,
		            button_text : '<span class="button">选择图片<span class="btn_startupload">(最大 2 MB)</span></span>',
		            button_text_style : '.button {font-size: 12px;color:#999999}',
		            button_text_top_padding: 4,
		            button_text_left_padding: 20,
		            button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
		            button_cursor: SWFUpload.CURSOR.HAND,
		
		            // Flash Settings
		            flash_url : "<?=base_url('resource/SwfUpload/js/swfupload/swfupload.swf') ?>",
		
		            custom_settings : {
		                progressTarget : "fsUploadProgress1",
		                cancelButtonId : "btnCancel1"
		            },
					prevent_swf_caching : false, 
					preserve_relative_urls : false, 
		            // Debug Settings
		            debug: false
                });
                swfu2 = new SWFUpload({
		            // Backend Settings
		            upload_url: "<?=site_url('corporation/upload_cap') ?>",
		            post_params: {"PHPSESSID": "<?=session_id() ?>", 'field':'id_card_cap', 'user':'<?=$this->session->userdata('id') ?>'},
		
		            // File Upload Settings
		            file_size_limit : "2 MB",	// 2MB
		            file_types : "*.jpg;*.png;*.gif;*.jpeg",
		            file_types_description : "JPG Images",
		            file_upload_limit : "1",
		            file_post_name: "id_card_cap",
		
		            // Event Handler Settings - these functions as defined in Handlers.js
		            //  The handlers are not part of SWFUpload but are part of my website and control how
		            //  my website reacts to the SWFUpload events.
		            file_queued_handler : fileQueued,
		            file_queue_error_handler : fileQueueError,
		            file_dialog_complete_handler : fileDialogComplete,
		            upload_progress_handler : uploadProgress,
		            upload_error_handler : uploadError,
		            upload_success_handler : uploadSuccess,
		            upload_complete_handler : uploadComplete,
		
		            // Button Settings
		            button_image_url : "<?=base_url('resource/img/swf_btn.png') ?>",
		            button_placeholder_id : "spanButtonPlaceholder2",
		            button_width: 200,
		            button_height: 31,
		            button_text : '<span class="button">选择图片<span class="btn_startupload">(最大 2 MB)</span></span>',
		            button_text_style : '.button  {font-size: 12px;color:#999999}',
		            button_text_top_padding: 4,
		            button_text_left_padding: 20,
		            button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
		            button_cursor: SWFUpload.CURSOR.HAND,
		
		            // Flash Settings
		            flash_url : "<?=base_url('resource/SwfUpload/js/swfupload/swfupload.swf') ?>",
		
		            custom_settings : {
		                progressTarget : "fsUploadProgress2",
		                cancelButtonId : "btnCancel2"
		            },
					prevent_swf_caching : false, 
					preserve_relative_urls : false, 
		            // Debug Settings
		            debug: false
                });
	     };
</script>

<h4 class="title_01 title_02"><a>返回社团首页</a></h4>
<div  class="main_02">
<div id="request_comment">
	<p>申请细则：</p>
	<p>1. 申请创建社团需要通过实名认证，需要填写学生信息以及公民身份信息，你填写的身份信息最好和当前账号信息保持一致(姓名)</p>
	<p>2. 上传身份证以及学生证照，请确保字迹可辨认，以便管理员审核通过</p>
	<p>3. 申请创建的社团名将不可更改</p>
	<p>4. 如果审核通过，你会收到一条通知将指引你创建该社团, 并且改社团的省份以及学校信息与你的一直，不可更改</p>
	<p>5. 管理员审核之后无论通过与否你都将会收到一条通知</p>
	<p><?=form_button('roger_that', '明白', 'id="roger_that" class="pub_button"') ?></p>
</div>
<div id="add-corporation" class="hidden" >
	 <div id="swf_wrap">
	 	<div class="swf_wrap_i">
        	<label>学生证照：</label>
            <div class="swf_upload_button">
                <span id="spanButtonPlaceholder1"></span>
                <input type="button" value="开始上传" class="btn_startupload" onclick="swfu1.startUpload();"/>
                <input type="button" value="取消上传" id="btnCancel1" onclick="swfu1.cancelUpload();"/>
            </div>
            <div class="fieldset flash" id="fsUploadProgress1">
            </div>
         </div>
         <div class="swf_wrap_i">
         	<label>身份证照：</label>
            <div class="swf_upload_button">
                <span id="spanButtonPlaceholder2"></span>
                <input type="button" value="开始上传" class="btn_startupload" onclick="swfu2.startUpload();"/>
                <input type="button" value="取消上传" id="btnCancel2" onclick="swfu2.cancelUpload();"/>
            </div>
            <div class="fieldset flash" id="fsUploadProgress2">
            </div>
          </div>
        <div id="thumbnails"></div>
    </div>
	<?=form_open('corporation/request_add','class="form" id="request_form"')?>
		<span ><label>学号：</label>
			<div class="InputWrapper">
			<div class="InputInner">
					<?=form_input('st_card_number') ?>
			</div>
			</div>
		</span>
		<span ><label>身份证号：</label>
			<div class="InputWrapper">
			<div class="InputInner">
					<?=form_input('id_card_number') ?>
			</div>
			</div>
		</span>
		<span ><label>创建社团名：</label>
			<div class="InputWrapper">
			<div class="InputInner">
					<?=form_input('co_name') ?>
			</div>
			</div>
		</span>
		<span ><label>或许你有什么要对管理员说的，增加通过率哦亲~：</label>
			<table class="Textarea">
			<tbody>
				<tr>
					<td id="Textarea-tl"></td>
					<td id="Textarea-tm"></td>
					<td id="Textarea-tr"></td>
				</tr>
				<tr>
					<td id="Textarea-ml"></td>
					<td id="Textarea-mm" class="">
						<div>
							<?=form_textarea(array('name' => 'comment')) ?>
						</div>
					</td>
					<td id="Textarea-mr"></td>
				</tr>
				<tr>
					<td id="Textarea-bl"></td>
					<td id="Textarea-bm"></td>
					<td id="Textarea-br"></td>
				</tr>
			</tbody>
			</table>
		</span>
		<p class="li_d"><?=form_submit('submit', '提交申请','class="pub_button"') ?></p>
	<?=form_close() ?>
</div>  
</div>
*/
?>
<header class="subhead subheadline">
    <div class="container">
    </div>
</header>
<div class="container mainBody">
    <div class="mt20 feed_switcher">
        <span class="f20">创建社团</span>
        <div class="feed_op">
            <a href="/corporation">返回社团之家</a>
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

        <form class="form-horizontal hide" method="post" id="request_form">
            <fieldset>
                <legend>创建社团</legend>
                <div class="control-group">
                    <label class="control-label"><em>* </em>学号：</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="user_id" name="st_card_number">
                    	<span class="alert alert-error" id="">请输入学号</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><em>* </em>社团名：</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="input01" name="co_name">
                        <span class="alert alert-error" id="">请输入社团名</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">说明：</label>
                    <div class="controls">
                        <textarea class="input-xlarge" id="textarea" rows="3"  name="comment"></textarea>
                        <p class="help-block">或许你有什么要对管理员说的，增加通过率哦亲~</p>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" id="submit" class="btnDefault btnBlue">提交</button>
                    <a class="btnDefault" href="/corporation">取消</a>
                </div>
            </fieldset>
        </form>
    </div>
</div>