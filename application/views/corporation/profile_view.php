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
<?
/*
 <div id="sidebar">
	<div class="user_head_box sidebar_nav">
		<a href="<?=site_url('corporation/profile/' . $info['id'])?>" class="user_head"> <img id="" src="<?=avatar_url($info['avatar'], 'corporation', 'big') ?>" /> </a>
		<a href="" class="user_name"><?=$info['name']?></a>
	</div>
	<p>
	<? if($this->session->userdata('id')): ?>
		<? if(in_array($this->session->userdata('id'), $followers)): ?>
			<?=form_button(array('name' => 'follow', 'content' => '已关注', 'id' => $info['id'], 'disabled' => 'disabled'))?>
			<?=form_button(array('name' => 'unfollow', 'content' => '取消关注', 'id' => $info['id']))?>
		<? else:?>
			<?=form_button(array('name' => 'follow', 'content' => '关注', 'id' => $info['id']))?>

		<? endif?>
	<? endif ?>
	</p>
	<p>
	<? if($this->session->userdata('id')): ?>
		<? if(in_array($this->session->userdata('id'), $members)): ?>
			<?=form_button(array('name' => 'join', 'content' => '已加入', 'co_id' => $info['id'], 'disabled' => 'disabled'))?>
			<?=form_button(array('name' => 'unjoin', 'content' => '退出社团', 'co_id' => $info['id'], 'id'=>'leave_co'))?>
		<? else:?>
			<?=form_button(array('name' => 'join', 'content' => '请求加入', 'co_id' => $info['id'], 'id' => 'join_co'))?>

		<? endif?>
	<? endif ?>
	</p>
	<div class="sidebar_nav">
		<h4><strong>协会信息</strong></h4>
		<ul class="asso_info">
			<li>
				社长：<?=anchor('personal/profile/' . $info['user'][0]['id'], $info['user'][0]['name']) ?>
			</li>
		</ul>
		<p class="f-aaa">
			由 <?=$info['user'][0]['name'] ?> 创建
		</p>
		<p>
			<a href="#?w=500" rel="popup5" class="inline" id="more_info">更多资料</a>
		</p>
	</div>
	<div class="sidebar_nav">
		<h4>协会成员（<?=count($members) ?>）</h4>
		<ul class="asso_list asso_list_01">
		<? foreach($members_info as $member): ?>
			<li>
				<a class="asso_list_a_img" href="<?=site_url('personal/profile/' . $member['id']) ?>"><img src="<?=avatar_url($member['avatar'], 'personal', 'tiny') ?>" /></a>
				<a class="asso_list_a_name"><?=$member['name'] ?></a>
			</li>
		<? endforeach ?>
		</ul>
	</div>
</div> 
 <div id="main">
	<div class="asso_intro_box">
		<h3><?=$info['name'] ?><span><a href="<?=site_url('blog/' . $info['id'] . '/corporation')?>">社团日志</a></span><span><a href="<?=site_url('album/' . $info['id'] . '/corporation')?>">社团相册</a></span></h3>
		<p>
			<?=$info['comment'] ?>
		</p>
		<p class="">
			<?=anchor('corporation/setting/' . $info['id'], '社团设置','class="creat_button creat_act inline"') ?>
			<?=anchor('activity/add/' . $info['id'], '创建活动','class="creat_button creat_act inline"')?>
		</p>
	</div>
	<div class="search_item">
		<ul>
			<li class="sd01" id="co-01">
				<a href="#">社团动态&nbsp;(<?=count($posts['activity']) ?>)</a>
			</li>
			<li class="sd02" id="co-02">
				<a href="#">社团活动&nbsp;(<?=count($activities) ?>)</a>
			</li>
			<li class="sd03" id="co-03">
				<a href="#" onclick="gossips();">留言&nbsp;</a>
			</li>
		</ul>
	</div>
	<div id="feeds_container" class="feeds"></div>
		<div id="co_01">
			<?=$this->load->view('post/co_posts_view') ?>
		</div>
		<div id="co_02" class="hidden">
			<ul>
				<? foreach ($activities as $activity):?>
				<li class="feed_a">
				<div class="img_block">
					<?=anchor('corporation/profile/' . $info['id'], '<img src="'. avatar_url($info['avatar'], 'corporation', 'tiny') .'" >','class="head_pic"') ?>
				</div>
				<div class="feed_main">
					<div class="f_info">
						<a href="<?=site_url('corporation/profile/' . $info['id']) ?>"><?=$info['name']?></a><br>
						<span class="f_do"><?=anchor('activity/view/' . $activity['id'], $activity['name']) ?></span>
					</div>
					<div class="f_summary">
						<p class="f_pm">
							<span><?=jdate($activity['start_time'], FALSE) ?> 至 <?=jdate($activity['deadline'], FALSE) ?></span>
						</p>
					</div>
				</li>
				<? endforeach ?>
			</ul>
		</div>
		<div id="co_03" class="hidden">
		<div class="massege_wrap">
			<h3 class="h3_line">最新留言</h3>
			<div class="massege" id="gossips_container">
			</div>
			<div class="leave_massege">
			<? if($this->session->userdata('type') != 'guest'): ?>
				<div class="comment_wrap">
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
										<?=form_textarea(array('name' => 'content', 'id' => 'gossips_content', 'cols' => 50, 'rows' =>1,'class'=>'comment_textarea')) ?>
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
					<p><?=form_button('gossips', '留言', 'class="pub_button comment_button"') ?></p>
				</div>
				<? else: ?>
					<p>要后登录才能留言哦~ <?=anchor('index/login?jump='.uri_string(), '马上登录>>') ?></p>
				<? endif ?>
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
<!--                            --><?//=form_button(array('name' => 'follow', 'content' => '已关注', 'id' => $info['id'], 'disabled' => 'disabled'))?>
                            <button name="follow" id="<?= $info['id'] ?>" class="btnDefault btn_m btn_n btn_l" type="" disabled="disabled">
                                已关注
                            </button>
                            <button name="unfollow" id="<?= $info['id'] ?>" class="btnDefault btn_m btn_r" type="" >
                                取消关注
                            </button>
<!--                            --><?//=form_button(array('name' => 'unfollow', 'content' => '取消关注', 'id' => $info['id']))?>
                        <? else:?>
<!--                            --><?//=form_button(array('name' => 'follow', 'content' => '关注', 'id' => $info['id'], 'class' => 'btnDefault btn_m'))?>
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