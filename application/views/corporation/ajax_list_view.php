<? if(count($corporations) > 0):?>
	<? foreach($corporations as $corporation) :?>
    <li class="asso_a">
        <a class="asso_img">
            <img src="img/asso/assoBig-1.jpg" alt=""/>
        </a>
        <a class="asso_tit" href="/corporation/profile/<?=$corporation['id']?>" title="<?=$corporation['name']?>"><?=$corporation['name']?></a>
        <div class="asso_extra clearfix">
            <span class="fl"><?=$corporation['school'][0]['name']?></span>
            <a class="fr"><i class="ico ico_member"></i>100</a>
        </div>
    </li>
    <? endforeach ?>
<? endif ?>