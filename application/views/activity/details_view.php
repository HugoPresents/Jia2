<!--
<pre>
<?=print_r($info) ?>
</pre>
-->
<!--<h4 class="title_01 title_02"><span>活动详细</span>--><?//=anchor('corporation/profile/' . $info['corporation'][0]['id'], '返回' . $info['corporation'][0]['name']) ?><!--</h4>-->
<!--<div class="main_02">-->
<!--	<h2 class="ac_title">--><?//=anchor('corporation/profile/' . $info['corporation'][0]['id'], $info['corporation'][0]['name']) . ' 的' . $info['user'][0]['name'] . '童鞋发起了 ' . $info['name']?><!--</h2>-->
<!--	<div class="ac_01">-->
<!--		<h3>活动时间</h3>-->
<!--		<p>-->
<!--			--><?//=jdate($info['start_time']) . '-' . jdate($info['deadline'])?>
<!--		</p>-->
<!--	</div>-->
<!--	<div class="ac_01">-->
<!--		<h3>活动地点</h3>-->
<!--		<p>-->
<!--			--><?//=$info['address']?>
<!--		</p>-->
<!--	</div>-->
<!--	<h3>活动详情</h3>-->
<!--	<div class="ac_01">-->
<!--		<p>-->
<!--			--><?//=$info['detail']?>
<!--		</p>-->
<!--		<div class="admin-options"></div>-->
<!--		--><?//=anchor('activity/edit/' . $info['id'], '编辑活动')?>
<!--	</div>-->
<!--</div>-->

<div class="mainContainer">
    <div class="container">
        <div class="profile_pic_top"></div>
        <div class="asso_profile_hd">
            <div class="asso_head">
                <div class="asso_head_pic"><img src="img/asso/assoHead100-1.jpg"/></div>
                <ul class="user_atten clearfix">
                    <li class=""><a class="S_func1" href=""><strong node-type="follow">20</strong><span>关注 </span></a>
                    </li>
                    <li class=""><a class="S_func1" href=""><strong node-type="fans">27</strong><span>粉丝</span></a></li>
                    <li class="noBorder"><a class="S_func1" name="profile_tab" href=""><strong
                                node-type="weibo">24</strong><span>状态</span></a></li>
                </ul>
            </div>
            <div class="asso_info clearfix">
                <div class="asso_name">三个代表协会</div>
                <div class="asso_tags">
                    位置 <a href="">四川省</a>
                    <span class="vline">|</span>
                    在 <a href="">成都信息工程学院</a>
                    <span class="vline">|</span>
                    <a class="btnDefault btn_s" href="">管理社团资料</a>
                </div>
                <div class="asso_btns">
                    <span class="btnDefault btn_m" href=""><i class="ico ico_atten"></i>关注</span>
                    <span class="btnDefault btn_m btn_n" href=""><i class="ico ico_atten"></i>已关注 | <a
                            href="">取消</a></span>
                    <span class="btnDefault btn_m" href=""><i class="ico ico_join"></i>加入</span>
                    <span class="btnDefault btn_m btn_n" href=""><i class="ico ico_join"></i>已加入 | <a
                            href="">退出</a></span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mainBody">
    <div class="mt20 clearfix feed_switcher">
        <a title="" href="javascript:void(0);" id="filter_all" class="switch first selected">最新动态</a>
        <a title="" href="javascript:void(0);" id="filter_photo" class="switch">活动相册</a>
        <a title="" href="javascript:void(0);" id="filter_dairy" class="switch last">活动日志</a>
    </div>

    <div class="main">
        <div class="main_02">
            <h3 class="ac_title">活动标题</h3>
            <div class="ac_01">
                <h4>活动时间</h4>
                <p>
                    2010-05-28 14:00:00
                </p>
            </div>
            <div class="ac_01">
                <h4>活动地点</h4>
                <p>
                    成都信息工程学院小罗马广场
                </p>
            </div>
            <h4>活动详情</h4>
            <div class="ac_01 last">
                <p>申请细则：</p>
                <p>1. 申请创建社团需要通过实名认证，需要填写学生信息以及公民身份信息，你填写的身份信息最好和当前账号信息保持一致(姓名)</p>
                <p>2. 上传身份证以及学生证照，请确保字迹可辨认，以便管理员审核通过</p>
                <p>3. 申请创建的社团名将不可更改</p>
                <p>4. 如果审核通过，你会收到一条通知将指引你创建该社团, 并且改社团的省份以及学校信息与你的一直，不可更改</p>
                <p>5. 管理员审核之后无论通过与否你都将会收到一条通知</p>

                <div class="admin-options"><a class="btnDefault" href="">编辑活动</a></div>
            </div>
            <!-- 管理员才显示  -->
            <form class="form-horizontal">
                <fieldset>
                    <legend>编辑活动</legend>
                    <div class="control-group">
                        <label class="control-label">活动名称：</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" id="input01">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">活动时间：</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" id="input02">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">活动地点：</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" id="input03">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">活动说明：</label>
                        <div class="controls">
                            <textarea class="input-xlarge" id="textarea" rows="6"></textarea>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btnDefault btnBlue">提交</button>
                        <button class="btnDefault">取消</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>


    <div class="siderbar">
        <dl class="sidebar_nav">
            <dt>参加的成员</dt>
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
                <p style="clear: both; font-size: 14px; padding-top: 15px;"><a href="#">> 浏览所以成员（100）</a></p>
            </dd>
        </dl>

        <dl class="sidebar_nav">
            <dt>关注的同学</dt>
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