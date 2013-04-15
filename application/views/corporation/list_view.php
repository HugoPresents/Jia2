<!-- <h4 class="title_01"><?=$title ?></h4>
<div  class="tab_cont_box content_1">
	<div id="a1">
		<ul id="corporation-result">
			<? if(!empty($corporations)):?>
			<? foreach($corporations as $row):?>
			<li class="box_1">
				<a><?=anchor('corporation/profile/' . $row['id'], '<img src="' . avatar_url($row['avatar'], 'corporation', 'big') . '">', 'class="head_pic"')?></a>
				<h3><?=anchor('corporation/profile/' . $row['id'], $row['name'])?></h3>
				<p><?=$row['comment'] ?></p>
			</li>
			<? endforeach?>
			<? endif?>
		</ul>
	</div>
</div> -->
<header class="found_hd subhead">
        <div class="container">
        </div>
    </header>
    <div class="container mainBody">
        <div class="mt20 clearfix feed_switcher">
            <a title="理论学习类" href="javascript:void(0);" id="" class="first selected">理论学习类</a>
            <a title="社会实践类" href="javascript:void(0);" id="" class="">社会实践类</a>
            <a title="社会实践类" href="javascript:void(0);" id="" class="">文化艺术类</a>
            <a title="社会实践类" href="javascript:void(0);" id="" class="">兴趣爱好类</a>
            <a title="社会实践类" href="javascript:void(0);" id="" class="">学术科技类</a>
            <a title="文化艺术类" href="javascript:void(0);" id="" class="last">其他类</a>
        </div>
        <div class="loading">
            <img src="img/loading.gif"/><span>正在加载，请稍候...</span>
        </div>
        <ul class="asso_wrap clearfix">
            <li class="asso_a">
                <a class="asso_img">
                    <img src="img/asso/assoBig-1.jpg" alt=""/>
                </a>
                <a class="asso_tit" href="" title="数学建模协会">数学建模协会</a>
                <div class="asso_extra clearfix">
                    <span class="fl">成都信息工程学院</span>
                    <a class="fr"><i class="ico ico_member"></i>100</a>
                </div>
            </li>
            <li class="asso_a">
                <a class="asso_img">
                    <img src="img/asso/assoBig-2.jpg" alt=""/>
                </a>
                <a class="asso_tit" href="" title="前端开发俱乐部">前端开发俱乐部</a>
                <div class="asso_extra clearfix">
                    <span class="fl">成都信息工程学院</span>
                    <a class="fr"><i class="ico ico_member"></i>100</a>
                </div>
            </li>
            <li class="asso_a">
                <a class="asso_img">
                    <img src="img/asso/assoBig-3.jpg" alt=""/>
                </a>
                <a class="asso_tit" href="" title="启明拓展协会">启明拓展协会</a>
                <div class="asso_extra clearfix">
                    <span class="fl">成都信息工程学院</span>
                    <a class="fr"><i class="ico ico_member"></i>100</a>
                </div>
            </li>
            <li class="asso_a">
                <a class="asso_img">
                    <img src="img/asso/assoBig-4.jpg" alt=""/>
                </a>
                <a class="asso_tit" href="" title="唯美健身协会">唯美健身协会</a>
                <div class="asso_extra clearfix">
                    <span class="fl">成都信息工程学院</span>
                    <a class="fr"><i class="ico ico_member"></i>100</a>
                </div>
            </li>
            <li class="asso_a">
                <a class="asso_img">
                    <img src="img/asso/assoBig-5.jpg" alt=""/>
                </a>
                <a class="asso_tit" href="" title="">旋转音乐协会</a>
                <div class="asso_extra clearfix">
                    <span class="fl">成都信息工程学院</span>
                    <a class="fr"><i class="ico ico_member"></i>100</a>
                </div>
            </li>
            <li class="asso_a">
                <a class="asso_img">
                    <img src="img/asso/assoBig-8.jpg" alt=""/>
                </a>
                <a class="asso_tit" href="" title="">旋转魔方</a>
                <div class="asso_extra clearfix">
                    <span class="fl">成都信息工程学院</span>
                    <a class="fr"><i class="ico ico_member"></i>100</a>
                </div>
            </li>

        </ul>
    </div>