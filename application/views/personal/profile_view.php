<?
/*
 <div id="main">
	<h3>&nbsp;<?=$info['name'] ?>&nbsp;&nbsp;</h3>
	<p><span class="profile_info">位置&nbsp;<a><?=$info['province'][0]['name']?></a></span>|
		<span class="profile_info">在&nbsp;<a><?=$info['school'][0]['name']?></a></span>|
		<span class="profile_info"><?=anchor('album/'.$info['id'], '相册') ?></span>|
		<span class="profile_info"><?=anchor('blog/'.$info['id'], '日志') ?></span>|
		<span class="profile_info"><a href="#?w=500" rel="popup4" class="inline">更多资料</a></span></p>
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
			<div id="cc02" class="hidden">
				第二层内容
			</div>
		</div>
	</div>
</div>
*/
?>
<div class="mainContainer">
    <div class="container">
        <div class="profile_pic_top"></div>
        <div class="asso_profile_hd">
            <div class="asso_head">
                <div class="asso_head_pic"><img src="<?=avatar_url($info['avatar'], 'personal', 'big')?>"/></div>
                <ul class="user_atten clearfix">
                    <li class=""><a class="S_func1" href="<?=site_url('personal/manage/following') ?>"><strong node-type="follow"><?=$following_num ?></strong><span>关注 </span></a>
                    </li>
                    <li class=""><a class="S_func1" href="<?=site_url('personal/manage/follower') ?>"><strong node-type="fans"><?=$followers_num ?></strong><span>粉丝</span></a></li>
                    <li class="noBorder"><a class="S_func1" name="profile_tab" href=""><strong node-type="weibo"><?=$post_count?></strong><span>状态</span></a></li>
                </ul>
            </div>
            <div class="asso_info clearfix">
                <div class="asso_name"><?=$info['name']?></div>
                <div class="asso_tags">
                    位置 <a href=""><?=$info['province'][0]['name']?></a>
                    <span class="vline">|</span>
                    在 <a href=""><?=$info['school'][0]['name']?></a>
                </div>
	                <? if($this->session->userdata('id') != $info['id'] ): ?>
	                 <div class="asso_btns">
		                <? if(in_array($this->session->userdata('id'), $followers)): ?>
						<span class="btnDefault btn_m btn_n" href=""><i class="ico ico_atten"></i>已关注 | <a href="">取消</a></span>
						<? else: ?>
						<span class="btnDefault btn_m" href=""><i class="ico ico_atten"></i>关注</span>
						<? endif ?>
               		</div>
                <? endif ?>
            </div>

            <div class="asso_infoC">
                <p>加入于 <span class="blue"><?=date('Y-m-d', $info['regist_time'])?></span>
                </p>
                <p><?=$info['description']?></p>
            </div>
            <div class="asso_pics">
                <p>最近上传照片</p>
                <div class="pics_wrap">
                    <? foreach($recent_photos as $photo): ?>
                    <a href="<?=site_url('album/lists/'.$photo['album_id'])?>"><img src="<?=base_url($photo['thumb'])?>" alt=""/></a>
                    <? endforeach; ?>
                </div>

            </div>

        </div>
    </div>
</div>
<div class="container mainBody">
    <div class="mt20 clearfix feed_switcher">
        <a title="" href="javascript:void(0);" id="filter_all" class="first selected">最新动态</a>
        <a title="" href="javascript:void(0);" id="filter_photo" class="">活动相册</a>
        <a title="" href="javascript:void(0);" id="filter_dairy" class="last">活动日志</a>
    </div>

    <div class="main">
        <!-- feeds begin -->
        <div class="feeds">
            <div class="loading">
                <img src="img/loading.gif"/><span>正在加载，请稍候...</span>
            </div>

            <? $this->load->view('post/user_posts_view') ?>
        </div>
        <!-- feeds end -->
    </div>


    <? $this->load->view('includes/slider_bar_view_pro') ?>
</div>

	
