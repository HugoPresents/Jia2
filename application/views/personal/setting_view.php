<script>
	window.onload = setingtab;
</script>
<div id="main">
	<div class="search_item">
			<ul>
				<li id="s01" class="sd01">
					<a href="#info">资料设置</a>
				</li>
				<li id="s02" class="sd02" >
				<a href="#avatar">头像设置</a>
				</li>
				<li id="s03" class="sd02" >
					<a href="#account">账户设置</a>
				</li>
				<li id="s04" class="sd02" >
					<a href="#privacy">隐私设置</a>
				</li>
			</ul>
	</div>
	<div class="tab_cont_box user_setting">
		<div id="c01">
			<h4 class="set_title"><span><?=$info['name'] ?></span>，你好！<a id="modify" href="#">修改</a></h4>
			<ul id="user_info">
				<li class="li_1">姓名：<span><?=$info['name'] ?></span></li>
				<li class="li_1">性别：<span><?=$info['gender'] == 1 ? '男' : '女' ?></span></li>
				<li class="li_1">学校：<span><?=$info['school'][0]['name']?></span></li>
				<li class="li_1">省份：<span><?=$info['province'][0]['name']?></span></li>
			</ul>
			<ul id="user_info_form" class="hidden">
			<?=form_open('personal/do_setting','class="form"')?>
			<?=form_hidden('setting', 'info') ?>
				<li><label>姓名：</label>
					<div class="InputWrapper"><div class="InputInner">
							<?=form_input('name', $info['name']) ?>
					</div></div>
				</li>
				<li><label>性别：</label>
					<?=form_dropdown('gender', array('1'=> '男', '0' => '女'),'class="SelectWrapper"') ?></li>
				<li>
					<label>生日：</label>
					<div class="InputWrapper"><div class="InputInner">
					<?=form_input('birthday', date('m/d/Y', $info['birthday']), 'id="birthday"') ?>
					</div></div>
				</li>
				<li>
					<label>个性签名：</label>
					<div class="InputWrapper" style="width: 300px"><div class="InputInner">
					<?=form_input('description', $info['description']) ?>
					</div></div>
				</li>
				<li><label>学校：</label>
							<?=form_dropdown('school', $schools ,'class="SelectWrapper"') ?></li>
				<li><label>省份：</label><?=form_dropdown('province', $provinces ,'class="SelectWrapper"') ?></li>
				<li class="li_b"><?=form_submit('submit', '保存','class="pub_button"') ?></li>
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
		<div id="c02" class="hidden">
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
				<?=form_upload('userfile') ?>
			</span>
			<?=form_hidden('setting', 'avatar') ?>
			
			<?=form_submit('submit', '上传','class="pub_button file_btn"') ?>
			<?=form_close() ?>
			
			<h4 class="set_title">当前头像</h4>
			<img src="<?=avatar_url($info['avatar'], 'personal', 'big') ?>" />
		</div>
		<div id="c03" class="hidden">
			<h4 class="set_title">修改密码</h4>
			<ul id="pass_setting">
			<?=form_open('personal/do_setting','class="form" id="pass"')?>
			<?=form_hidden('setting', 'pass') ?>
				<li><label>原  密  码: </label>
					<div class="InputWrapper"><div class="InputInner">
							<?=form_password('old_pass') ?>
					</div></div><span class="prompt" id="old_pass_prompt"></span>
				</li>
				<span class="prompt" id="old_pass_prompt"></span>
				<li><label>新  密  码: </label>
					<div class="InputWrapper"><div class="InputInner">
							<?=form_password('pass') ?>
					</div></div><span class="prompt" id="pass_prompt"></span>
				</li>
				<span class="prompt" id="pass_prompt"></span>
				<li><label>确认密码: </label>
					<div class="InputWrapper"><div class="InputInner">
							<?=form_password('pass_check') ?>
					</div></div><span class="prompt" id="pass_check_prompt"></span>
				</li>
				<span class="prompt" id="pass_check_prompt"></span>
				<li class="li_c"><?=form_submit('submit', '修改','class="pub_button" id="pass_submit"') ?></li>
			<?=form_close() ?>
			</ul>
		</div>
		<div id="c04" class="hidden">
			<h4 class="set_title">隐私设置</h4>
			<ul id="pass_setting">
			<?=form_open('personal/do_setting','class="form"')?>
			<?=form_hidden('setting', 'privacy') ?>
				<li ><label>浏览权限: </label><?=form_dropdown('post', array('guest' => '所有人&nbsp;', 'register' => '注册用户', 'follower' => '仅粉丝', 'self' => '仅自己'), $privacy['post'],'class="SelectWrapper"') ?></li>
				<li ><label>评论权限: </label><?=form_dropdown('comment', array('register' => '注册用户&nbsp;','follower' => '仅粉丝', 'self' => '仅自己'), $privacy['comment'],'class="SelectWrapper"') ?></li>
				<li class="li_c"><?=form_submit('submit', '更新','class="pub_button"') ?></li>
			<?=form_close() ?>
			</ul>
		</div>
	</div>
</div>
<script language="javascript"> 
    var url=location.href;
    var str = url.substr(1);
    var strs = str.split("#");
    var name=strs[1];
    
    switch(name){
    case 'avatar':
     	 $("#s01").removeClass("sd01").addClass("sd02");
         $("#s02").removeClass("sd02").addClass("sd01");
         $("#c01").css("display","none");
         $("#c02").css("display","block");
         break;
    case 'account':
   		 $("#s01").removeClass("sd01").addClass("sd02");
         $("#s03").removeClass("sd02").addClass("sd01");
         $("#c01").css("display","none");
         $("#c03").css("display","block");
         break;
    case 'privacy':
     	 $("#s01").removeClass("sd01").addClass("sd02");
         $("#s04").removeClass("sd02").addClass("sd01");
         $("#c01").css("display","none");
         $("#c04").css("display","block");
         break;
    default: 
         break;
	}
</script> 		
