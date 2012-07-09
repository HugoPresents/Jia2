<div id="sidebar">
	<div class="user_head_box sidebar_nav">
		<?=anchor('personal/profile/' . $info['id'], '<img src="'. avatar_url($info['avatar'], 'personal', 'big') .'" >','class="user_head"') ?>
		<a href="<?=site_url('personal/profile/' . $info['id']) ?>" class="user_name"><?=$info['name'] ?></a>
	</div>
	<div class="sidebar_nav">
		<ul class="ul_sty_01">
			<li><a class="a_sty_01"><i class="ico ico_newthings"></i>姓名：<?=$info['name'] ?></a></li>
			<li><a class="a_sty_01"><i class="ico ico_newthings"></i>性别：<?=$info['gender'] == 1 ? '男' : '女' ?></a></li>
			<li><a class="a_sty_01"><i class="ico ico_newthings"></i>学校：<?=$info['school'][0]['name']?></a></li>
			<li><a class="a_sty_01"><i class="ico ico_newthings"></i>省份：<?=$info['province'][0]['name']?></a></li>
		</ul>
	</div>
	<? if($info['id'] == $this->session->userdata('id')): ?>
	<div class="sidebar_nav">
		<ul class="ul_sty_01">
			<li><a class="a_sty_01" href="<?=site_url('personal/manage/follower') ?>"><i class="ico ico_newthings"></i>我的粉丝(<?=$followers_num ?>)</a></li>
			<li><a class="a_sty_01" href="<?=site_url('personal/manage/following') ?>"><i class="ico ico_newthings"></i>我的关注(<?=$following_num ?>)</a></li>
		</ul>
	</div>
	<? endif ?>
	
</div>
<!-- 	发表说说	 -->
<div id="popup1" class="popup_block">
<form id="inline_pub">
	<div class="inline_textarea"><textarea  cols="60" rows="2" name="mytext"></textarea></div>
	<div class="inline_button">
		<?=form_button('post', '发布') ?>
	</div>
</form>   
</div>