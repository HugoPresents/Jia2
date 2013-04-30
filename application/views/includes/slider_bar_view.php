<?
/*
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
<div id="popup1" class="popup_block">
<form id="inline_pub">
	<div class="inline_textarea"><textarea  cols="60" rows="2" name="mytext"></textarea></div>
	<div class="inline_button">
		<?=form_button('post', '发布') ?>
	</div>
</form>   
</div>
*/
?>
<div class="siderbar">
          <div class="user_head_box sidebar_nav">
            <a href="" class="user_head"><img src="" data-pinit="registered"></a>  
            <a href="" class="user_name">demo</a>
          </div>
          <div class="sidebar_nav">
            <a class="a_sty_01" href="<?=site_url('blog/post')?>"><i class="ico ico_dairy"></i>写日志</a>
            <a class="a_sty_01" href="<?=site_url('album/index')?>"><i class="ico ico_photo"></i>传照片</a>
            <a class="a_sty_01" href="<?=site_url('corporation/request_add')?>"><i class="ico ico_asso"></i>创建社团</a>
          </div>
          <dl class="sidebar_nav">
            <dt>管理的社团（1）</dt>
            <dd class="clearfix">
            <a class="a_sty_02" href="#">
              <img src="img/asso/asso50-1.png"><br>点点网
            </a>
            <a class="a_sty_02" href="#">
              <img src="img/asso/asso50-2.jpeg"><br>点点网
            </a> 
            <a class="a_sty_02" href="#">
              <img src="img/asso/asso50-3.jpeg"><br>点点网
            </a>          
            </dd>
          </dl>
          <dl class="sidebar_nav">
            <dt>加入的社团（2）</dt>
            <dd class="clearfix">
            <a class="a_sty_02" href="#">
              <img src="img/asso/asso50-4.jpeg"><br>点点网
            </a>
            <a class="a_sty_02" href="#">
              <img src="img/asso/asso50-5.jpeg"><br>点点网
            </a>  
            <a class="a_sty_02" href="#">
              <img src="img/asso/asso50-6.jpeg"><br>点点网
            </a>           
            </dd>
          </dl>
          <dl class="sidebar_nav">
            <dt>粉丝（2）</dt>
            <dd class="clearfix">
            <a class="a_sty_02" href="#">
              <img src="img/img50_g.png"><br>我的粉
            </a> 
            <a class="a_sty_02" href="#">
              <img src="img/img50_b.png"><br>我的粉丝
            </a>          
            </dd>
          </dl>
        </div>