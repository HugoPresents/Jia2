<div class="mainContainer">
    <div class="container">
    	<div id="main">
			<ul class="nav nav-tabs" id="myTab">
				<li class="active">
					<a href="#c01"  data-toggle="tab">资料设置</a>
				</li>
				<li>
					<a href="#c02"  data-toggle="tab">头像设置</a>
				</li>
				<li>
					<a href="#c03"  data-toggle="tab">账户设置</a>
				</li>
				<li>
					<a href="#c04"  data-toggle="tab">隐私设置</a>
				</li>
			</ul>
	<div class="tab-content">
		<div id="c01" class="tab-pane active">
			<h4 class="set_title"><span><?=$info['name'] ?></span>，你好！<a id="modify" href="#" class="fr">修改</a></h4>
			<ul id="user_info">
				<li class="li_1">姓名：<span><?=$info['name'] ?></span></li>
				<li class="li_1">性别：<span><?=$info['gender'] == 1 ? '男' : '女' ?></span></li>
				<li class="li_1">学校：<span><?=$info['school'][0]['name']?></span></li>
				<li class="li_1">省份：<span><?=$info['province'][0]['name']?></span></li>
			</ul>
			
			<ul id="user_info_form" style="display:none">
			<?=form_open('personal/do_setting','class="form-horizontal"')?>
			<?=form_hidden('setting', 'info') ?>
			<div class="control-group">
			    <label class="control-label" for="inputEmail">姓名：</label>
			    <div class="controls">
			      <?=form_input('name', $info['name']) ?>
			    </div>
			  </div>
			  <div class="control-group">
			    <label class="control-label" for="inputEmail">性别：</label>
			    <div class="controls">
			      <?=form_dropdown('gender', array('1'=> '男', '0' => '女'),'class="SelectWrapper"') ?>
			    </div>
			  </div>
			  <div class="control-group">
			    <label class="control-label" for="inputEmail">生日：</label>
			    <div class="controls">
			     <?=form_input('birthday', date('m/d/Y', $info['birthday']), 'id="birthday"') ?>
			    </div>
			  </div>
			  <div class="control-group">
			    <label class="control-label" for="inputEmail">个性签名：</label>
			    <div class="controls">
			     <?=form_input('description', $info['description']) ?>
			    </div>
			  </div>
			  <div class="control-group">
			    <label class="control-label" for="inputEmail">学校：</label>
			    <div class="controls">
			     <?=form_dropdown('school', $schools ,'class="SelectWrapper"') ?>
			    </div>
			  </div>
			  <div class="control-group">
			    <label class="control-label" for="inputEmail">学校：</label>
			    <div class="controls">
			     <?=form_dropdown('province', $provinces ,'class="SelectWrapper"') ?>
			    </div>
			  </div>
			  <div class="control-group">
			    <div class="controls">
			      <button type="submit" class="btn btn-info">保存</button>
			      <button class="btn">取消</button>
			    </div>
			  </div>
			<?=form_close() ?>
			<script type="text/javascript">
				$(function() {
			    	var dates = $( "#birthday" ).datepicker({  
			        defaultDate: "+1w",  
			        changeMonth: true,  
			        numberOfMonths: 1,
			        altFormat: "yy-mm-dd",
			        onSelect: function( selectedDate ) {  
			            var option = this.id == "from" ? "minDate" : "maxDate",  
			                instance = $( this ).data( "datepicker" ),  
			                date = $.datepicker.parseDate(  
			                    instance.settings.dateFormat ||  
			                    $.datepicker._defaults.dateFormat,  
			                    selectedDate, instance.settings );  
			            dates.not( this ).datepicker( "option", option, date );
			        	}  
			    	});  
				});  
			</script>
			</ul>
		</div>
		<div id="c02" class="tab-pane">
			<h4 class="set_title">提示</h4>
			<p>可能由于浏览器缓存的原因，你设置的头像没能及时更新，请尝试刷新页面查看新头像 ;)</p>
			<? if($tmp_avatar): ?>
			<script language="Javascript">
				$(function(){
					$('#cropbox').Jcrop({
						aspectRatio: 1,
						setSelect: [ 0, 0, 180, 180 ],
						onSelect: updateCoords
					});
	
				});
	
				function updateCoords(c)
				{
					$("input[name='crop_x']").val(c.x);
					$("input[name='crop_y']").val(c.y);
					$("input[name='crop_w']").val(c.w);
					$("input[name='crop_h']").val(c.h);
				};
	
				function checkCoords()
				{
					if (parseInt($('#w').val())) return true;
					alert('Please select a crop region then press submit.');
					return false;
				};
	
			</script>
			<div id="crop_avatar">
				<h4 class="set_title">剪裁头像</h4>
				<p>你已经上传了头像，请剪裁至合适尺寸，你也可以在下面上传新的图片</p>
				<img src="<?=$tmp_avatar ?>" id="cropbox" />
				<?=form_open('personal/do_setting') ?>
					<?=form_hidden('crop_x') ?>
					<?=form_hidden('crop_y') ?>
					<?=form_hidden('crop_w') ?>
					<?=form_hidden('crop_h') ?>
					<?=form_hidden('setting', 'avatar') ?>
					<?=form_hidden('target', 'tmp') ?>
					<?=form_submit('delete', '取消', 'class="pub_button"') ?>
					<?=form_submit('submit', '剪裁', 'class="pub_button"') ?>
				<?=form_close() ?>
			</div>
			<? endif ?>
			<h4 class="set_title">设置新头像</h4>
			<p class="p_1">	支持JPG、JPEG、GIF和PNG文件，最大2M。	</p>
			<?=form_open_multipart('personal/do_setting') ?>		
			<span href="" class="btn-blue">
				浏览
				<?=form_upload('userfile','', 'id="userfile"') ?>
			</span>
			<?=form_hidden('setting', 'avatar') ?>
			<?=form_submit('submit', '上传','class="pub_button file_btn" id="upload_avatar"') ?>
			<span id="filename">未选择文件</span>
			<?=form_close() ?>
			
			<h4 class="set_title">当前头像</h4>
			<img src="<?=avatar_url($info['avatar'], 'personal', 'big') ?>" />
		</div>
		<div id="c03" class="tab-pane">
			<h4 class="set_title">修改密码</h4>
			<ul id="pass_setting">
			<?=form_open('personal/do_setting','class="form-horizontal" id="pass"')?>
			<?=form_hidden('setting', 'pass') ?>
			<div class="control-group">
			    <label class="control-label">原  密  码：</label>
			    <div class="controls">
			      <?=form_password('old_pass') ?>
			    </div>
			</div>
			<div class="control-group">
			    <label class="control-label" for="inputEmail">新  密  码：</label>
			    <div class="controls">
			      <?=form_password('pass') ?>
			    </div>
			</div>
			<div class="control-group">
			    <label class="control-label" for="inputEmail">确认密码：</label>
			    <div class="controls">
			      <?=form_password('pass_check') ?>
			    </div>
			</div>
			<div class="control-group">
			    <div class="controls">
			      <button type="submit" class="btn btn-info">修改</button>
			      <button class="btn">取消</button>
			    </div>
			  </div>
			<?=form_close() ?>
			</ul>
		</div>
		<div id="c04" class="tab-pane">
			<h4 class="set_title">隐私设置</h4>
			<ul id="pass_setting">
			<?=form_open('personal/do_setting','class="form-horizontal"')?>
			<?=form_hidden('setting', 'privacy') ?>
				<div class="control-group">
			    <label class="control-label" for="inputEmail">浏览权限：</label>
				    <div class="controls">
				      <?=form_dropdown('post', array('guest' => '所有人&nbsp;', 'register' => '注册用户', 'follower' => '仅粉丝', 'self' => '仅自己'), $privacy['post'],'class="SelectWrapper"') ?>
				    </div>
				</div>
				<div class="control-group">
			    <label class="control-label" for="inputEmail">评论权限：</label>
				    <div class="controls">
				      <?=form_dropdown('comment', array('register' => '注册用户&nbsp;','follower' => '仅粉丝', 'self' => '仅自己'), $privacy['comment'],'class="SelectWrapper"') ?>
				    </div>
				</div>
				<div class="control-group">
			    <div class="controls">
			      <button type="submit" class="btn btn-info">更新</button>
			      <button class="btn">取消</button>
			    </div>
			  </div>
			<?=form_close() ?>
			</ul>
		</div>
	</div>
</div>
    </div>
</div>

	
<script type="text/javascript" src="<?=base_url('resource/js/new/tab.js') ?>"></script>
   	<script>
		$(function() {
			$('#myTab').tab('show');
			$(".modify").live("click",function () {
				$(this).closest(".tab-pane").find("#user_info").hide().end().find("#user_info_form").show();			  
				return false;
			});
		})
	</script>	
