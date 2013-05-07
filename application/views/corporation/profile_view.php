<script>
//		window.onload = coprotab;
		function gossips() {
			if($("#gossips").length > 0) {
				return false;
			} else {
				$.post(SITE_URL+'gossip', {
					ajax: 1,
					id: <?=$info['id']?>,
					type:'corporation'
				}, function(data) {
					$("#gossips_container").html(data);
				})
			}
		}
		$(function() {
			$("button[name='gossips']").click(function() {
				content = $("#gossips_content").val();
				if(content == '')
					return false;
				$("#gossips_content").val('');
				$.post(SITE_URL+'gossip/add', {
					ajax: 1,
					id: <?=$info['id'] ?>,
					type: 'corporation',
					content: content
				},function(data) {
					$("#tmp_gossip").remove();
					$("#gossips").append(data);
				})
			});
		});
</script>
<div class="mainContainer">
    <div class="container">
        <div class="profile_pic_top"></div>
        <div class="asso_profile_hd">
            <div class="asso_head">
                <div class="asso_head_pic"><img src="<?=avatar_url($info['avatar'], 'corporation', 'big')?>"/></div>
                <ul class="user_atten clearfix">
                    <li class=""><a class="S_func1"><strong node-type="follow"><?=count($members_ids)?></strong><span>成员 </span></a>
                    </li>
                    <li class=""><a class="S_func1"><strong node-type="fans"><?=count($followers_ids)?></strong><span>粉丝</span></a></li>
                    <li class="noBorder"><a class="S_func1" name="profile_tab"><strong node-type="weibo">24</strong><span>活动</span></a></li>
                </ul>
            </div>
            <div class="asso_info clearfix">
                <div class="asso_name"><?=$info['name']?></div>
                <div class="asso_tags">
                    位置 <a><?=$info['school'][0]['province'][0]['name']?></a>
                    <span class="vline">|</span>
                    在 <a><?=$info['school'][0]['name']?></a>
                    <span class="vline">|</span>
                    <a class="btnDefault btn_s" href="/corporation/setting/<?=$info['id']?>">管理社团资料</a>
                </div>
                <div class="asso_btns">
                    <? if($this->session->userdata('id')): ?>
                        <? if(in_array($this->session->userdata('id'), $followers_ids)): ?>
                            <button name="follow" id="<?= $info['id'] ?>" class="btnDefault btn_m btn_n btn_l" type="" disabled="disabled">
                                已关注
                            </button>
                            <button name="unfollow" id="<?= $info['id'] ?>" class="btnDefault btn_m btn_r" type="" >
                                取消关注
                            </button>
                        <? else:?>
                            <button name="follow" id="<?= $info['id'] ?>" class="btnDefault btn_m" type="" >
                                <i class="ico ico_atten"></i>关注
                            </button>
                        <? endif?>
                    <? endif ?>
                	<? if($this->session->userdata('id')): ?>
						<? if(in_array($this->session->userdata('id'), $members_ids)): ?>
							<?=form_button(array('name' => 'join','class'=>'btnDefault btn_m btn_n btn_l', 'content' => '已加入', 'co_id' => $info['id'], 'disabled' => 'disabled'))?>
							<?=form_button(array('name' => 'unjoin', 'class'=>'btnDefault btn_m btn_r','content' => '退出社团', 'co_id' => $info['id'], 'id'=>'leave_co'))?>
						<? else:?>
							<?=form_button(array('name' => 'join', 'class' => 'btnDefault btn_m','content' => '<i class="ico ico_join"></i>请求加入', 'co_id' => $info['id'], 'id' => 'join_co'))?>
						<? endif?>
					<? endif ?>
                </div>
            </div>
            <div class="asso_infoC">
                <p>社长： <span class="blue"><a href="/personal/profile/<?=$info['user'][0]['id']?>"><?=$info['user'][0]['name']?></a></span></p>
                <p><?=$info['comment']?></p>
            </div>
        </div>
    </div>
</div>
<div class="container mainBody">
    <div class="mt20 clearfix feed_switcher  btn-group">
        <a title="" href="javascript:void(0);" id="filter_all" class="switch selected btn">最新动态</a>
        <a title="" href="javascript:void(0);" id="filter_dairy" class="switch btn">活动</a>
    </div>

    <div class="main">
        <!-- feeds begin -->
        <div class="feeds">
           <? $this->load->view('post/co_posts_view') ?>
        </div>
        <!-- feeds end -->
    </div>
    <div class="siderbar">
        <dl class="sidebar_nav">
            <dt>成员(<?=count($members_ids)?>)</dt>
            <dd class="clearfix">
                <? if($members_ids): ?>
                <? foreach($members as $user): ?>
                <a class="a_sty_02" href="/personal/profile/<?=$user['id']?>">
                    <img src="<?=avatar_url($user['avatar'])?>" onerror="onImgError(this);"><br><?=$user['name']?>
                </a>
                <? endforeach ?>
                <? endif ?>
            </dd>
        </dl>
        <dl class="sidebar_nav">
            <dt>粉丝(<?=count($followers)?>)</dt>
            <dd class="clearfix">
                <? if($followers_ids): ?>
                <? foreach($followers as $user): ?>
                <a class="a_sty_02" href="/personal/profile/<?=$user['id']?>">
                    <img src="<?=avatar_url($user['avatar'])?>" onerror="onImgError(this);"><br><?=$user['name']?>
                </a>
                <? endforeach ?>
                <? endif ?>
            </dd>
        </dl>
    </div>
</div>