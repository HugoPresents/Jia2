<script>
$(function(){
	$(".Checked").toggle(function(){
			$(this).removeClass("Checked").addClass("Checkbox");
			$(this).children().removeAttr('checked');
		},function(){
			$(this).removeClass("Checkbox").addClass("Checked");
			$(this).children().attr("checked", "checked");
		})
	$(".Checkbox").toggle(function(){
			$(this).removeClass("Checkbox").addClass("Checked");
			$(this).children().attr("checked", "checked");
		},function(){
			$(this).removeClass("Checked").addClass("Checkbox");
			$(this).children().removeAttr('checked');
		})
})
</script>
<!--<div id="main">-->
<!--	<h3>&nbsp;搜索&nbsp;<span id="searh_key">“--><?//=trim($this->input->post('keywords')) ?><!--”</span></h3>-->
<!--	<div id="search_box">-->
<!--		<div id="search-bar">-->
<!--			--><?//=form_open('search', 'id="in_search_form"') ?>
<!--			--><?//=form_hidden('offset', 0) ?>
<!--			--><?//=form_input('keywords', isset($_POST['keywords']) ? $_POST['keywords'] : '','class="serch_input" id="in_search_content"')?>
<!--			--><?//=form_submit('submit', '搜索','class="btn-blue" id="in_search"')?>
<!--		</div>-->
<!--	</div>-->
<!--	<p id="chose_box">-->
<!--		<span class="CheckboxWrapper --><?//=($_POST['user'] == 1) ? 'Checked' : 'Checkbox' ?><!--">-->
<!--			<input type="checkbox" name="user" id="check_user" value="1" class="chbox" --><?//=($_POST['user'] == 1) ? 'checked="checked"' : '' ?><!--/>-->
<!--		</span>-->
<!--		<span class="Checkitem">用户</span>-->
<!--		<span class="CheckboxWrapper --><?//=($_POST['corporation'] == 1) ? 'Checked' : 'Checkbox' ?><!--">-->
<!--			<input type="checkbox" name="corporation" id="check_corporation" value="1" class="chbox" --><?//=($_POST['corporation'] == 1) ? 'checked="checked"' : '' ?><!--/>-->
<!--		</span>-->
<!--		<span class="Checkitem">社团</span>-->
<!--		<span class="CheckboxWrapper --><?//=($_POST['activity'] == 1) ? 'Checked' : 'Checkbox' ?><!--">-->
<!--			<input type="checkbox" name="activity" id="check_activity" value="1" class="chbox" --><?//=($_POST['activity'] == 1) ? 'checked="checked"' : '' ?><!--/>-->
<!--		</span>-->
<!--		<span class="Checkitem">活动</span>-->
<!--	</p>-->
<!--		--><?//=form_close() ?>
<!--	<div class="search_item">-->
<!--			<ul>-->
<!--				<li class="sd01" id="01">-->
<!--					<a href="#" id="active">搜索结果&nbsp;</a>-->
<!--				</li>-->
<!--			</ul>-->
<!--	</div>-->
<!--	<div id="search_result_01" class="search_result">-->
<!--		--><?// if(isset($user_result)): ?>
<!--		<h4>人名 <span>--><?//=$user_rows?><!--条结果</span></h4>-->
<!--		<ul id="user-result">-->
<!--			--><?// if(isset($user_result)):?>
<!--			--><?// foreach($user_result as $row):?>
<!--			<li>-->
<!--				--><?//=anchor('personal/profile/' . $row['id'], '<img src="' . avatar_url($row['avatar'], 'personal', 'big') . '">', 'class="head_pic" target="_blank"')?>
<!--				<div class="li_mbox">-->
<!--					<h3>--><?//=anchor('personal/profile/' . $row['id'], $row['name'], 'target="_blank"')?><!--</h3>-->
<!--					<p>--><?//=$row['gender'] == 1 ? '男' : '女'?><!--</p>-->
<!--					<p>--><?//=$row['province'][0]['name'] ?><!--</p>-->
<!--					<p>--><?//=$row['school'][0]['name'] ?><!--</p>-->
<!--				</div>-->
<!--			</li>-->
<!--			--><?// endforeach?>
<!--			--><?// endif?>
<!--		</ul>-->
<!--		--><?// endif ?>
<!--		--><?// if(isset($corporation_result)): ?>
<!--		<h4>社团 <span>--><?//=$corporation_rows?><!--条结果</span></h4>-->
<!--		<ul id="corporation-result">-->
<!--			--><?// if(isset($corporation_result)):?>
<!--			--><?// foreach($corporation_result as $row):?>
<!--			<li>-->
<!--				--><?//=anchor_popup('corporation/profile/' . $row['id'], '<img src="' . avatar_url($row['avatar'], 'corporation', 'big') . '">', 'class="head_pic"')?>
<!--				<div class="li_mbox">-->
<!--					<h3>--><?//=anchor_popup('corporation/profile/' . $row['id'], $row['name'])?><!--</h3>-->
<!--				</div>-->
<!--			</li>-->
<!--			--><?// endforeach?>
<!--			--><?// endif?>
<!--		</ul>-->
<!--		--><?// endif ?>
<!--		--><?// if(isset($activity_result)): ?>
<!--		<h4>活动 <span>--><?//=$activity_rows?><!--条结果</span></h4>-->
<!--		<ul id="activity-result">-->
<!--			--><?// if(isset($activity_result)):?>
<!--			--><?// foreach($activity_result as $row):?>
<!--			<li>-->
<!--				--><?//=anchor_popup('activity/view/' . $row['id'], '<img src="' . avatar_url($row['corporation'][0]['avatar'], 'corporation', 'big') . '">', 'class="head_pic"')
//				?>
<!--				<div class="li_mbox">-->
<!--					<h3>--><?//=anchor_popup('activity/view/' . $row['id'], $row['name'])
//					?><!--</h3>-->
<!--				</div>-->
<!--			</li>-->
<!--			--><?// endforeach?>
<!--			--><?// endif?>
<!--		</ul>-->
<!--		--><?// endif ?>
<!--	</div>-->

<header class="subhead subheadline">
    <div class="container">
        <!--<h1>加加社团网</h1>-->
        <p class="lead">分享校园生活！感动你我！</p>
        <div class="search_wrap">
            <div class="checkboxes">
                <label class="checkbox">
                    <input type="checkbox"> 用户
                </label>
                <label class="checkbox">
                    <input type="checkbox"> 社团
                </label>
                <label class="checkbox">
                    <input type="checkbox"> 活动
                </label>
            </div>
            <div class="input-append">
                <input class="span4" id="appendedInputButtons" type="text">
                <button class="btn" type="button">Search</button>
            </div>
        </div>

    </div>
</header>
<div class="container mainBody">
    <div class="searchmain">

        <div class="switcher_wrap clearfix">
            <span class="fr">&nbsp;搜索&nbsp;<q id="searh_key">“zzz”</q>&nbsp;的结果</span>
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#user"  data-toggle="tab">用户</a></li>
                <li><a href="#asso"  data-toggle="tab">社团</a></li>
                <li><a href="#activity"  data-toggle="tab">活动</a></li>
            </ul>
        </div>

        <div class="tab-content">
            <!--用户-->
            <div class="tab-pane active" id="user">
                <ul class="clearfix">
                    <li class="asso_w">
                        <div class="img_80 fl">
                            <a href="assoProfile.html" class="thumbnail">
                                <img src="img/asso/assoBig-8.jpg" />
                            </a>
                        </div>
                        <div class="asso_brief fl">
                            <a class="name" href="" title="">用户名</a>
                            <p class="">男 <em class="vline">|</em> 四川省 <em class="vline">|</em> 成都信息工程学院</p>
                            <p class="person_num">
                                <span>关注<a href="" target="_blank">50</a></span>
                                <em class="vline">|</em>
                                <span>粉丝<a href="" target="_blank">203</a></span>
                                <em class="vline">|</em>
                                <span>动态<a href="" target="_blank">146</a></span>
                            </p>
                        </div>
                        <div class="adbtn">
                            <span href="" class="btnDefault btn_m"><i class="ico ico_atten"></i>关注</span>
                            <!--<span href="" class="btnDefault btn_m btn_n"><i class="ico ico_atten"></i>已关注 | <a href="">取消</a></span>-->
                        </div>
                    </li>
                </ul>
            </div>
            <!--社团-->
            <div class="tab-pane" id="asso">
                <ul class="clearfix">
                    <li class="asso_w">
                        <div class="img_80 fl">
                            <a href="assoProfile.html" class="thumbnail">
                                <img src="img/asso/assoBig-7.jpg" />
                            </a>
                        </div>
                        <div class="asso_brief fl">
                            <a class="name" href="" title="">社团名字什么的</a>
                            <p class="">四川省 <em class="vline">|</em> 成都信息工程学院</p>
                            <p class="person_num">
                                <span>成员<a href="" target="_blank">50</a></span>
                                <em class="vline">|</em>
                                <span>粉丝<a href="" target="_blank">203</a></span>
                                <em class="vline">|</em>
                                <span>动态<a href="" target="_blank">146</a></span>
                            </p>
                        </div>
                        <div class="adbtn">
                            <span href="" class="btnDefault btn_m"><i class="ico ico_join"></i>加入</span>
                            <!--<span href="" class="btnDefault btn_m btn_n"><i class="ico ico_join"></i>已加入 | <a href="">退出</a></span>-->
                        </div>
                    </li>
                </ul>
            </div>
            <!--活动-->
            <div class="tab-pane" id="activity">
                <ul class="clearfix">
                    <li class="asso_w">
                        <div class="img_80 fl">
                            <a href="assoProfile.html" class="thumbnail">
                                <img src="img/asso/assoBig-5.jpg" />
                            </a>
                        </div>
                        <div class="asso_brief fl">
                            <p class=""><a href="" title="">社团名字</a> 创建了 <a href="" title="">活动名字</a> </p>
                            <p class="person_num">
                                <span>成员<a href="" target="_blank">50</a></span>
                                <em class="vline">|</em>
                                <span>粉丝<a href="" target="_blank">203</a></span>
                            </p>
                        </div>
                        <div class="adbtn">
                            <span href="" class="btnDefault btn_m"><i class="ico ico_join"></i>加入</span>
                            <!--<span href="" class="btnDefault btn_m btn_n"><i class="ico ico_join"></i>已加入 | <a href="">退出</a></span>-->
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <script>
            $(function () {
                $('#myTab').tab('show')
            })
        </script>

    </div>
    <div class="searchside">
        <img src="img/advertisement/shetuanzhijia_01.jpg" alt=""/>
    </div>