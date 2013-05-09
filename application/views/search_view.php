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
<header class="subhead subheadline">
    <div class="container">
        <p class="lead">分享校园生活！感动你我！</p>
        <div class="search_wrap">
            <div class="input-append">
                <form action="/search">
                    <input class="span4" id="appendedInputButtons" name="keywords" value="<?=$this->input->get('keywords')?>" type="text">
                    <input type="hidden" name="target" value="<?=$object?>" />
                    <input type="submit" class="btn" value="Search">
                </form>
            </div>
        </div>
    </div>
</header>
<div class="container mainBody">
    <div class="searchmain">
        <div class="switcher_wrap clearfix">
            <span class="fr">&nbsp;搜索&nbsp;<q id="searh_key">“<?=$this->input->get('keywords')?>”</q>&nbsp;的结果</span>
            <ul class="nav nav-tabs">
                <li<?=$object == 'user' ? ' class="active"' :''?>><a href="<?=site_url('search/?target=user&keywords='.$this->input->get('keywords'))?>">用户</a></li>
                <li<?=$object == 'corporation' ? ' class="active"' :''?>><a href="<?=site_url('search/?target=corporation&keywords='.$this->input->get('keywords'))?>">社团</a></li>
                <li<?=$object == 'activity' ? ' class="active"' :''?>><a href="<?=site_url('search/?target=activity&keywords='.$this->input->get('keywords'))?>">活动</a></li>
            </ul>
        </div>
        <div>
            <? if($object == 'user'): ?>
            <!--用户-->
            <div class="" id="">
                <ul class="clearfix">
                    <? foreach($user_result as $user): ?>
                    <li class="asso_w">
                        <div class="img_80 fl">
                            <a href="/personal/profile/<?=$user['id']?>" class="thumbnail">
                                <img src="<?=avatar_url($user['avatar'], 'personal', 'big')?>" />
                            </a>
                        </div>
                        <div class="asso_brief search_brief fl">
                            <a class="name" href="/personal/profile/<?=$user['id']?>"><?=$user['name']?></a>
                            <p class="">男 <? if(!empty($user['province'][0]['name'])): ?><span class="vline">|</span><? endif ?><?= $user['province'][0]['name']?><? if(!empty($user['school'][0]['name'])): ?><span class="vline">|</span><? endif ?> <?=$user['school'][0]['name']?></p>
                        </div>
                    </li>
                    <? endforeach; ?>
                    <div class="pagination"><?=$pagination ?></div>
                </ul>
            </div>
            <? endif ?>
            <? if($object == 'corporation'): ?>
            <!--社团-->
            <div class="">
                <ul class="clearfix">
                    <? foreach($corporation_result as $corporation): ?>
                    <li class="asso_w">
                        <div class="img_80 fl">
                            <a href="/corporation/profile/<?=$corporation['id']?>" class="thumbnail">
                                <img src="<?=avatar_url($corporation['avatar'], 'corporation', 'big')?>" />
                            </a>
                        </div>
                        <div class="asso_brief search_brief fl">
                            <a class="name" href="/corporation/profile/<?=$corporation['id']?>"><?=$corporation['name']?></a>
                            <p class=""><?=$corporation['school'][0]['province'][0]['name']?> <em class="vline">|</em> <?=$corporation['school'][0]['name']?></p>
                            <p class="person_num">
                                <span>社长<a href="/personal/profile/<?=$corporation['user'][0]['id']?>" target="_blank"><?=$corporation['user'][0]['name']?></a></span>
                            </p>
                        </div>
                    </li>
                    <? endforeach ?>
                    <div class="pagination"><?=$pagination ?></div>
                </ul>
            </div>
            <? endif ?>
            <? if($object == 'activity'): ?>
            <!--活动-->
            <div class="">
                <ul class="clearfix">
                    <? foreach($activity_result as $activity): ?>
                    <li class="asso_w">
                        <div class="img_80 fl">
                            <a href="/corporation/profile/<?=$activity['corporation'][0]['id']?>" class="thumbnail">
                                <img src="<?=avatar_url($activity['corporation'][0]['avatar'], 'corporation', 'big')?>" />
                            </a>
                        </div>
                        <div class="asso_brief search_brief fl">
                            <p class="">
                             <a href="/activity/view/<?=$activity['id']?>" title=""><?=$activity['name']?></a>
                             <br>
                             &nbsp;<span style="color:gray;"><?=$activity['detail']?></span>
                            </p>
                            <p class="person_num">
                                <span>创建社团<a href="/corporation/profile/<?=$activity['corporation'][0]['id']?>" target="_blank"><?=$activity['corporation'][0]['name']?></a></span>
                                <em class="vline">|</em>
                                <span>创建时间<a><?=time2duration($activity['time'])?></a></span>
                            </p>
                        </div>
                    </li>
                    <? endforeach ?>
                    <div class="pagination"><?=$pagination ?></div>
                </ul>
            </div>
            <? endif ?>
        </div>
    </div>
    <div class="searchside">
        <img src="http://localhost:8088/data/ad/ad_01.jpg" alt=""/>
        <img src="http://localhost:8088/data/ad/ad_02.jpg" alt=""/>
    </div>
</div>