<script>
		function gossips() {
			if($("#gossips").children().length > 0) {
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
			$("#gossipsBtn").live("click",function() {
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
					$("#gossips_container").append(data);
				})
			});
		});
var flag=false;
function DrawImage(ImgD){
    var image=new Image();
    image.src=ImgD.src;
    if(image.width>0 && image.height>0){
        flag=true;
        if(image.width/image.height>= 180/180){
//            if(image.width>180){
//                ImgD.width=180;
//                ImgD.height=(image.height*180)/image.width;
//            }else{
//                ImgD.width=image.width;
//                ImgD.height=image.height;
//            }
            if(image.height<180){
                ImgD.height=180;
                ImgD.width=(image.width*180)/image.height;
            }else{
//                ImgD.width=image.width;
//                ImgD.height=image.height;
            }
        }
        else{
            if(image.width<180){
                ImgD.width=180;
                ImgD.height=(image.width*180)/image.width;
            }else{
                ImgD.width=image.width;
                ImgD.height=image.height;
            }

        }
    }
}
</script>
<div class="mainContainer">
    <div class="container">
        <div class="profile_pic_top"></div>
        <div class="asso_profile_hd">
            <div class="asso_head">
                <div class="asso_head_pic"><img src="<?=avatar_url($info['avatar'], 'corporation', 'big')?>" height="180" width="180" onload="javascript:DrawImage(this);"/></div>
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
                    <a class="btnDefault btn_s" href="/activity/add/<?=$info['id']?>">创建活动</a>
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

<div class="container mainBody">
    <div class="mt20 clearfix feed_switcher  btn-group">
        <a title="" href="#feed_a" id="dynamic" class="switch selected btn tab" data-toggle="tab">社团动态</a>
        <a title="" href="#feed_f" id="activity" class="switch btn tab" data-toggle="tab">社团活动</a>
        <a title="" href="/blog/index/<?=$info['id']?>/corporation" id="dairy" class="switch btn">社团日志</a>
        <a title="" href="/album/index/<?=$info['id']?>/corporation" id="album" class="switch btn">社团相册</a>
        <a title="" href="#feed_gossip" id="message" class="switch btn tab" data-toggle="tab" onclick="gossips();">留言</a>
    </div>

    <div class="main">
        <!-- feeds begin -->
        <div class="feeds  tab-content">
            <div id="feed_a" class="feedUl tab-pane active">
                <? $this->load->view('post/co_posts_view') ?><!-- 社团动态-->
                <div class="loading"><img src="<?=base_url('resource/img/loading.gif') ?>"></img></div>
            </div>
            <div id="feed_f" class="feedUl tab-pane" >
<!--         社团活动       -->
                <ul>
                    <? foreach ($activities as $activity):?>
                        <li class="feed_a clearfix">
                            <div class="img_block fl">
                                <?=anchor('corporation/profile/' . $info['id'], '<img onerror="onImgError(this);" src="'. avatar_url($info['avatar'], 'corporation', 'tiny') .'" >','class="head_pic"') ?>
                            </div>
                            <div class="feed_main">
                                <div class="f_nick">
                                    <a href="<?=site_url('corporation/profile/' . $info['id']) ?>"><?=$info['name']?></a><br>
                                </div>
                                <div class="f_text"><?=anchor('activity/view/' . $activity['id'], $activity['name']) ?></div>
                                <div class="f_summary clearfix">
                                    <span><?=jdate($activity['start_time'], FALSE) ?> 至 <?=jdate($activity['deadline'], FALSE) ?></span>
                                </div>
                        </li>
                    <? endforeach ?>
                </ul>
                <div class="loading"><img src="<?=base_url('resource/img/loading.gif') ?>"></img></div>
            </div>
            <div id="feed_gossip"  class="feedUl tab-pane">
                <h3 class="h3_line">最新留言</h3>
                <div id="gossips_container" class="massege" >
                    <ul id="gossips"></ul>
                </div>
                <div class="leave_massege">
                    <div class="control-group">
                        <label class="control-label" for="inputEmail">留言：</label>
                        <div class="controls">
                            <textarea class="comment_textarea" id="gossips_content" name="content"></textarea>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <button class="btn btn-info" type="button" id="gossipsBtn">留言</button>
                    </div>
                </div>

            </div>

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
</div>
<script type="text/javascript" src="<?= base_url('resource/js/new/tab.js') ?>"></script>
<script>
    $(function () {
        $('.btn-group .btn').click(function (e) {
            $(".switch").removeClass("selected");
            $(this).addClass("selected");
        });
		$(".tab").click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        })
    });
</script>