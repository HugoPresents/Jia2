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
						<button name="follow" user_id="<?= $info['id'] ?>" class="btnDefault btn_m btn_n btn_l" type="" disabled="disabled">已关注</button>
                        <button name="unfollow" user_id="<?= $info['id'] ?>" class="btnDefault btn_m btn_r" type="" >取消关注</button>
						<? else: ?>
						<button name="follow" user_id="<?= $info['id'] ?>" class="btnDefault btn_m" type="" >
                            <i class="ico ico_atten"></i>关注
                        </button>
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
<div class="container mainBody">
    <div class="mt20 clearfix feed_switcher  btn-group">
        <a title="" href="javascript:void(0);" id="filter_all" class="switch selected btn" data-toggle="tab">最新动态</a>
        <a title="" href="/album/index/<?=$info['id']?>" id="filter_photo" class="switch btn">相册</a>
        <a title="" href="/blog/index/<?=$info['id']?>" id="filter_dairy" class="switch btn">日志</a>
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
    <div class="siderbar">
    <? $this->load->view('includes/slider_bar_corporations_view') ?>
    </div>
</div>
</div>

	
