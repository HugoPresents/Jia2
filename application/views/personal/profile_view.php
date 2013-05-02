<? $this->load->view('includes/slider_bar_view') ?>
<div id="main">
	<h3>&nbsp;<?=$info['name'] ?>&nbsp;&nbsp;</h3>
	<p>
		<span class="profile_info">位置&nbsp;<a><?=$info['province'][0]['name']?></a></span>|
		<span class="profile_info">在&nbsp;<a><?=$info['school'][0]['name']?></a></span>|
		<span class="profile_info"><?=anchor('album/'.$info['id'], '相册') ?></span>|
		<span class="profile_info"><?=anchor('blog/'.$info['id'], '日志') ?></span>|
		<span class="profile_info"><a href="#?w=500" rel="popup4" class="inline">更多资料</a></span>
	</p>
	<? if($this->session->userdata('id') != $info['id'] ): ?>
		<? if(in_array($this->session->userdata('id'), $followers)): ?>
			<?=form_button(array('name' => 'follow', 'content' => '已关注', 'user_id' => $info['id'], 'disabled' => 'disabled')) ?>
			<?=form_button(array('name' => 'unfollow', 'content' => '取消关注', 'user_id' => $info['id'])) ?>
		<? else: ?>
			<?=form_button(array('name' => 'follow', 'content' => '关注', 'user_id' => $info['id'])) ?>
		<? endif ?>
	<? endif ?>
	<div class="new_things">
		<div class="clear"></div>
		<div class="article_box">
			<? $this->load->view('post/user_posts_view') ?>
		</div>
	</div>
</div>

<!-- 	个人资料 -->
<div id="popup4" class="popup_block">
	<h4 class="set_title"><span><?=$info['name'] ?></span></h4>
		<ul id="user_info">
			<li class="li_1">姓名：<span><?=$info['name'] ?></span></li>
			<li class="li_1">性别：<span><?=$info['gender'] == 1 ? '男' : '女' ?></span></li>
			<li class="li_1">生日：<span><?=jdate($info['birthday'], FALSE)?></span></li>
			<li class="li_1">个性签名：<span><?=$info['description']?></span></li>
			<li class="li_1">学校：<span><?=$info['school'][0]['name']?></span></li>
			<li class="li_1">省份：<span><?=$info['province'][0]['name']?></span></li>
		</ul>
</div>  
</div>