<?
/*
<script>
	window.onload = cotab;
</script>
<div id="main">
	<a href="<?=site_url('corporation/request_add') ?>" class="creat_button button"><i>+</i> 申请创建社团</a>
	<span><?=anchor('corporation/list_by_school', '查看全校社团','class="creat_button btn_01"') ?></span>
	<div id="search_box">
		<div id="search-bar">
			<?=form_open('search') ?>
			<?=form_hidden('offset', 0) ?>
			<?=form_hidden('corporation', 1) ?>
			<?=form_input('keywords','','class="serch_input" id="in_search_content"')?>
			<?=form_submit('submit', '搜索','class="btn-blue" id="in_search"')?>
			<?=form_close() ?>
		</div>
	</div>
	<div class="search_item">
		<ul>
			<li class="sd01" id="co-1">
				<a href="#" id="active">我的社团&nbsp;(<?=$j_num ?>)</a>
			</li>
			<li class="sd02" id="co-2">
				<a href="#">我关注的社团&nbsp;(<?=$f_num ?>)</a>
			</li>
		</ul>
	</div>
	<div id="feeds_container" class="feeds">
	<ul id="feed_1">
		<? if(!empty($j_corporations)): ?>
			<? foreach($j_corporations as $corporation):?>
				<li class="feed_a">
					<div class="img_block"><img src="<?=avatar_url($corporation['avatar'], 'corporation', 'big') ?>" /></div>
						<div class="feed_main">
						<h3 class="asso_name"><a href="<?=site_url('corporation/profile/' . $corporation['id'])?>"><?=$corporation['name'] ?></a></h3>
						<ul class="asso_ul">
							<li><a><?=$corporation['comment'] ?></a></li>
						</ul>
					</div>
				</li>
			<? endforeach?>
		<? else: ?>
			<p> 还没有加入社团？ 赶紧搜索一个或者<?=anchor('corporation/list_all', '查看全部社团') ?></p>
		<? endif ?>
			
		</li>
	</ul>
	<ul id="feed_2" class="hidden">
		<? if(!empty($f_corporations)): ?>
			<? foreach($f_corporations as $corporation):?>
				<li class="feed_a">
					<div class="img_block"><img src="<?=avatar_url($corporation['avatar'], 'corporation', 'big') ?>" /></div>
						<div class="feed_main">
						<h3 class="asso_name"><a href="<?=site_url('corporation/profile/' . $corporation['id'])?>"><?=$corporation['name'] ?></a></h3>
						<ul class="asso_ul">
							<li><a><?=$corporation['comment'] ?></a></li>
						</ul>
					</div>
				</li>
			<? endforeach?>
		<? else: ?>
			<p> 还没有关注社团？ 赶紧搜索一个或者<?=anchor('corporation/list_all', '查看全部社团') ?></p>
		<? endif ?>
	</ul>
	</div>
	</div>	
</div>
*/
?>
<header class="subhead">
    <div class="container"></div>
</header>
<div class="container mainBody">
    <div class="mt20 clearfix feed_switcher">
        <a title="理论学习类" href="javascript:void(0);" id="" class="switch first selected">我管理的社团</a>
        <a title="社会实践类" href="javascript:void(0);" id="" class="switch">我参加的社团</a>
        <a title="社会实践类" href="javascript:void(0);" id="" class="switch last">我关注的社团</a>
        <div class="feed_op">
            <a href="<?=site_url('corporation/request_add') ?>" target="_blank" class="btnDefault " >创建社团</a>
            <a href="found.html" target="_blank" class="btnDefault btnBlue" >发现社团</a>
        </div>
    </div>

    <ul class="asso_mg">
        <li class="asso_w clearfix">
            <div class="img_100 fl">
                <a href="assoProfile.html" class="thumbnail">
                    <img src="img/asso/assoBig-8.jpg" />
                </a>
            </div>
            <div class="asso_brief fl">
                <h4 class="asso_name"><a href="" class="a3">坑爹社团</a></h4>
                <p class="c9">创建于 2010-05-28  |  社长： zzzz   |   已有 100 位成员</p>
                <p class="c6">欢迎各位学习型友邻在此分享小经验、小感悟、小方法！希望这里是促发你要去做点什么有趣的事情的好平台！</p>
                <div class="asso_handle">
                    <a type="button" class="btnDefault btnBlue" >管理社团</a>
                </div>
            </div>
        </li>
        <li class="asso_w clearfix">
            <div class="img_100 fl">
                <a class="thumbnail" href="#">
                    <img src="img/asso/assoBig-5.jpg" />
                </a>
            </div>
            <div class="asso_brief fl">
                <h4 class="asso_name"><a href="img/asso/assoBig-6.jpg" class="a3">坑爹社团</a></h4>
                <p class="c9">创建于 2010-05-28  |  社长： zzzz   |   已有 100 位成员</p>
                <p class="c6">欢迎各位学习型友邻在此分享小经验、小感悟、小方法！希望这里是促发你要去做点什么有趣的事情的好平台！</p>
                <div class="asso_handle">
                    <a type="button" class="btnDefault" >退出社团</a>
                </div>
            </div>
        </li>
        <li class="asso_w clearfix">
            <div class="img_100 fl">
                <a class="thumbnail" href="#">
                    <img src="img/asso/assoBig-7.jpg" />
                </a>
            </div>
            <div class="asso_brief fl">
                <h4 class="asso_name"><a href="" class="a3">坑爹社团</a></h4>
                <p class="c9">创建于 2010-05-28  |  社长： zzzz   |   已有 100 位成员</p>
                <p class="c6">欢迎各位学习型友邻在此分享小经验、小感悟、小方法！希望这里是促发你要去做点什么有趣的事情的好平台！</p>
                <div class="asso_handle">
                    <a type="button btnBlue" class="btnDefault" >取消关注</a>
                </div>
            </div>
        </li>


    </ul>

    <h3>全校社团</h3>
    <ul class="thumbnails">
        <li class="span3">
            <a class="thumbnail">
                <img src="img/asso/assoBig-1.jpg" alt="">
                <p class="asso_tit" href="" title="数学建模协会">数学建模协会</p>
            </a>
        </li>
        <li class="span3">
            <a class="thumbnail">
                <img src="img/asso/assoBig-2.jpg" alt="">
                <p class="asso_tit" href="" title="数学建模协会">数学建模协会</p>
            </a>
        </li>
        <li class="span3">
            <a class="thumbnail">
                <img src="img/asso/assoBig-3.jpg" alt="">
                <p class="asso_tit" href="" title="数学建模协会">数学建模协会</p>
            </a>
        </li>
        <li class="span3">
            <a class="thumbnail">
                <img src="img/asso/assoBig-4.jpg" alt="">
                <p class="asso_tit" href="" title="数学建模协会">数学建模协会</p>
            </a>
        </li>
    </ul>
</div>