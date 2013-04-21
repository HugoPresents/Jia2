
<!-- <div id="main">-->
<!--	<h3>&nbsp;--><?//=$info['name'] ?><!--&nbsp;&nbsp;</h3>-->
<!--	<p><span class="profile_info">位置&nbsp;<a>--><?//=$info['province'][0]['name']?><!--</a></span>|-->
<!--		<span class="profile_info">在&nbsp;<a>--><?//=$info['school'][0]['name']?><!--</a></span>|-->
<!--		<span class="profile_info">--><?//=anchor('album/'.$info['id'], '相册') ?><!--</span>|-->
<!--		<span class="profile_info">--><?//=anchor('blog/'.$info['id'], '日志') ?><!--</span>|-->
<!--		<span class="profile_info"><a href="#?w=500" rel="popup4" class="inline">更多资料</a></span></p>-->
<!--		--><?// if($this->session->userdata('id') != $info['id'] ): ?>
<!--			--><?// if(in_array($this->session->userdata('id'), $followers)): ?>
<!--				--><?//=form_button(array('name' => 'follow', 'content' => '已关注', 'user_id' => $info['id'], 'disabled' => 'disabled')) ?>
<!--				--><?//=form_button(array('name' => 'unfollow', 'content' => '取消关注', 'user_id' => $info['id'])) ?>
<!--			--><?// else: ?>
<!--				--><?//=form_button(array('name' => 'follow', 'content' => '关注', 'user_id' => $info['id'])) ?>
<!--			--><?// endif ?>
<!--		--><?// endif ?>
<!--	<div class="new_things">-->
<!--		<div class="clear"></div>-->
<!--		<div class="article_box">-->
<!--			--><?// $this->load->view('post/user_posts_view') ?>
<!--			<div id="cc02" class="hidden">-->
<!--				第二层内容-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
<div class="mainContainer">
    <div class="container">
        <div class="profile_pic_top"></div>
        <div class="asso_profile_hd">
            <div class="asso_head">
                <div class="asso_head_pic"><img src="img/asso/assoHead100-1.jpg"/></div>
                <ul class="user_atten clearfix">
                    <li class=""><a class="S_func1" href="<?=site_url('personal/manage/following') ?>"><strong node-type="follow"><?=$following_num ?></strong><span>关注 </span></a>
                    </li>
                    <li class=""><a class="S_func1" href="<?=site_url('personal/manage/follower') ?>"><strong node-type="fans"><?=$followers_num ?></strong><span>粉丝</span></a></li>
                    <li class="noBorder"><a class="S_func1" name="profile_tab" href=""><strong node-type="weibo">24</strong><span>状态</span></a></li>
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
                    <img src="img/asso/assoBig-1.jpg" alt=""/>
                    <img src="img/asso/assoBig-2.jpg" alt=""/>
                    <img src="img/asso/assoBig-3.jpg" alt=""/>
                    <img src="img/asso/assoBig-4.jpg" alt=""/>
                    <img src="img/asso/assoBig-5.jpg" alt=""/>
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


    <? $this->load->view('includes/slider_bar_view_pro') ?>
</div>

	
