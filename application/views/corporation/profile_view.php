<script>
		window.onload = coprotab;
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
                <div class="asso_head_pic"><img src="img/asso/assoHead100-1.jpg"/></div>
                <ul class="user_atten clearfix">
                    <li class=""><a class="S_func1" href=""><strong node-type="follow">20</strong><span>成员 </span></a>
                    </li>
                    <li class=""><a class="S_func1" href=""><strong node-type="fans">27</strong><span>粉丝</span></a></li>
                    <li class="noBorder"><a class="S_func1" name="profile_tab" href=""><strong node-type="weibo">24</strong><span>活动</span></a></li>
                </ul>
            </div>
            <div class="asso_info clearfix">
                <div class="asso_name"><?=$info['name']?></div>
                <div class="asso_tags">
                    位置 <a href="">四川省</a>
                    <span class="vline">|</span>
                    在 <a href=""><?=$info['school'][0]['name']?></a>
                    <span class="vline">|</span>
                    <a class="btnDefault btn_s" href="/corporation/setting/<?=$info['id']?>">管理社团资料</a>
                </div>
                <div class="asso_btns">
                	<? if($this->session->userdata('id')): ?>
						<? if(in_array($this->session->userdata('id'), $members)): ?>
							<?=form_button(array('name' => 'join', 'content' => '已加入', 'co_id' => $info['id'], 'disabled' => 'disabled'))?>
							<?=form_button(array('name' => 'unjoin', 'content' => '退出社团', 'co_id' => $info['id'], 'id'=>'leave_co'))?>
						<? else:?>
							<?=form_button(array('name' => 'join', 'content' => '请求加入', 'co_id' => $info['id'], 'id' => 'join_co'))?>
				
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
    <div class="mt20 clearfix feed_switcher">
        <a title="" href="javascript:void(0);" id="filter_all" class="first selected">最新动态</a>
        <a title="" href="javascript:void(0);" id="filter_dairy" class="last">活动日志</a>
    </div>

    <div class="main">
        <!-- feeds begin -->
        <div class="feeds">
            <div class="loading">
                <img src="img/loading.gif"/><span>正在加载，请稍候...</span>
            </div>

            <div class="feed_a clearfix">
                <div class="img_block fl">
                    <a href="" class="head_pic"><img src="img/img50.jpeg"></a>
                </div>
                <div class="feed_main">
                    <div class="f_nick">
                        <a href="">用户名</a>
                    </div>
                    <div class="f_text">快乐悲伤来的快去的也快 → <a href="">点击查看</a></div>
                    <div class="f_summary clearfix">
                        <div class="fl"><span>今天10:49</span> 来自 <span>成都信息工程学院</span></div>
                        <div class="fr"><a href="javascript:;" class="Zan" fid=""><i class="ico ico_zan"></i>赞(<span
                                class="zanNum">0</span>)</a> <i class="S_txt">|</i> <a href="javascript:;"
                                                                                       class="Forward"> 转发(<span
                                class="forwardNum">0</span>)</a> <i class="S_txt">|</i> <a href="javascript:;"
                                                                                           class="CommetBtn">评论(<span
                                class="commet Num">0</span>) </a></div>
                    </div>
                    <div class="repeat">
                    <span class="arr">
                      <span class="arr_out"></span>
                      <span class="arr_in"></span>
                    </span>
                        <!-- 评论框  -->
                        <div class="comment_wrap">
                            <textarea class="W_input"></textarea>

                            <p class="btn_wrap clearfix">
                                <button name="post" type="button" class="W_btn fl">评论</button>
                            </p>
                        </div>
                        <div class="comment_lists">
                            <dl class="comment_list">
                                <dt><a href=""><img src="img/img30.jpeg" class="img30"></a></dt>
                                <dd><a href="">用户名:</a>你能少说两句吗 <br>18:52:50</dd>
                            </dl>
                            <dl class="comment_list">
                                <dt><a href=""><img src="img/img30.jpeg" class="img30"></a></dt>
                                <dd><a href="">用户名:</a>你能少说两句吗 <br>18:52:50</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="feed_a clearfix">
                <div class="img_block fl">
                    <a href="" class="head_pic"><img src="img/img50.jpeg"></a>
                </div>
                <div class="feed_main">
                    <div class="f_nick">
                        <a href="">用户名</a>
                    </div>
                    <div class="f_text">快乐悲伤来的快去的也快 → <a href="">点击查看</a></div>
                    <div class="f_imgs"><img src="img/img_sub.jpg"></div>
                    <!-- 转发 -->
                    <div class="f_expand" style="display: none;">
                    <span class="arr">
                      <span class="arr_out"></span>
                      <span class="arr_in"></span>
                    </span>

                        <div class="feed_main expand_feed_main">
                            <div class="f_nick">
                                <a href="">用户名</a>
                            </div>
                            <div class="f_text">快乐悲伤来的快去的也快 → <a href="">点击查看</a></div>
                            <div class="f_imgs"><img src="img/img_sub.jpg"></div>
                            <div class="f_summary clearfix">
                                <div class="fl"><span>今天10:49</span> 来自 <span>成都信息工程学院</span></div>
                                <div class="fr"><a href="javascript:;" class="Zan" fid=""><i
                                        class="ico ico_zan"></i>赞(<span class="zanNum">0</span>)</a> <i
                                        class="S_txt">|</i> <a href="javascript:;" class="Forward"> 转发(<span
                                        class="forwardNum">0</span>)</a> <i class="S_txt">|</i> <a href="javascript:;"
                                                                                                   class="CommetBtn">评论(<span
                                        class="commet Num">0</span>) </a></div>
                            </div>
                        </div>
                        <!-- 转发 end -->

                    </div>
                    <!-- 评论等toolbar-->
                    <div class="f_summary clearfix">
                        <div class="fl"><span>今天10:49</span> 来自 <span>成都信息工程学院</span></div>
                        <div class="fr"><a href="javascript:;" class="Zan" fid=""><i class="ico ico_zan"></i>赞(<span
                                class="zanNum">0</span>)</a> <i class="S_txt">|</i> <a href="javascript:;"
                                                                                       class="Forward"> 转发(<span
                                class="forwardNum">0</span>)</a> <i class="S_txt">|</i> <a href="javascript:;"
                                                                                           class="CommetBtn">评论(<span
                                class="commet Num">0</span>) </a></div>
                    </div>
                    <div class="repeat">
                    <span class="arr">
                      <span class="arr_out"></span>
                      <span class="arr_in"></span>
                    </span>
                        <!-- 评论框  -->
                        <div class="comment_wrap">
                            <textarea class="W_input"></textarea>

                            <p class="btn_wrap clearfix">
                                <button name="post" type="button" class="W_btn fl">评论</button>
                            </p>
                        </div>
                        <div class="comment_lists">
                            <dl class="comment_list">
                                <dt><a href=""><img src="img/img30.jpeg" class="img30"></a></dt>
                                <dd><a href="">用户名:</a>你能少说两句吗 <br>18:52:50</dd>
                            </dl>
                            <dl class="comment_list">
                                <dt><a href=""><img src="img/img30.jpeg" class="img30"></a></dt>
                                <dd><a href="">用户名:</a>你能少说两句吗 <br>18:52:50</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- feeds end -->
    </div>


    <div class="siderbar">
        <dl class="sidebar_nav">
            <dt>最新加入</dt>
            <dd class="clearfix">
                <a class="a_sty_02" href="#">
                    <img src="img/img50_g.png"><br>我的粉
                </a>
                <a class="a_sty_02" href="#">
                    <img src="img/img50_b.png"><br>我的粉丝
                </a>
                <a class="a_sty_02" href="#">
                    <img src="img/img50_g.png"><br>我的粉
                </a>
                <a class="a_sty_02" href="#">
                    <img src="img/img50_b.png"><br>我的粉丝
                </a>
                <a class="a_sty_02" href="#">
                    <img src="img/img50_g.png"><br>我的粉
                </a>
                <a class="a_sty_02" href="#">
                    <img src="img/img50_b.png"><br>我的粉丝
                </a>
                <p style="clear: both; font-size: 14px; padding-top: 15px;"><a href="/corporation/setting/<?=$info['id']?>">> 浏览所以成员（100）</a></p>
            </dd>
        </dl>

        <dl class="sidebar_nav">
            <dt>粉丝</dt>
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

</div>

	
