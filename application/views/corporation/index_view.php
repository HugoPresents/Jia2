<header class="subhead subheadline">
    <div class="container"></div>
</header>
<div class="container mainBody">
    <div class="mt20 clearfix feed_switcher">
        <?
        $first = FALSE;
        if($m_corporations): ?>
        <a title="我管理的社团" href="javascript:void(0);" id="" class="switch<?= $first ? '':' first'?> selected">我管理的社团</a>
        <? $first = TRUE;endif ?>
        <? if($j_corporations): 
        ?>
        <a title="我参加的社团" href="javascript:void(0);" id="" class="switch<?= $first ? '':' first'?>">我参加的社团</a>
        <? $first = TRUE;endif ?>
        <? if($f_corporations): ?>
        <a title="我关注的社团" href="javascript:void(0);" id="" class="switch<?= $first ? '':' first'?> last">我关注的社团</a>
        <? $first = TRUE;endif ?>
        <div class="feed_op">
            <a href="<?=site_url('corporation/request_add') ?>" target="_blank" class="btnDefault" >创建社团</a>
            <a href="/search/?target=corporation" target="_blank" class="btnDefault btnBlue" >发现社团</a>
        </div>
    </div>
    <ul class="asso_mg">
        <? if($m_corporations): ?>
        <? foreach($m_corporations as $corporation): ?>
        <li class="asso_w clearfix">
            <div class="img_100 fl">
                <a href="/corporation/profile/<?=$corporation['id']?>" class="thumbnail">
                    <img src="<?=avatar_url($corporation['avatar'], 'corporation', 'big')?>" />
                </a>
            </div>
            <div class="asso_brief fl">
                <h4 class="asso_name"><a href="/corporation/profile/<?=$corporation['id']?>" class="a3"><?=$corporation['name']?></a></h4>
                <p class="c9"><?=$corporation['school'][0]['name']?> | 社长：<a href="/personal/profile/<?=$corporation['user'][0]['id']?>"><?=$corporation['user'][0]['name']?></a></p>
                <p class="c6"><?=$corporation['comment']?></p>
                <div class="asso_handle">
                    <a type="button" href="/corporation/setting/<?=$corporation['id']?>" class="btnDefault btnBlue" >管理社团</a>
                </div>
            </div>
        </li>
        <? endforeach ?>
        <? endif ?>
        <? if($j_corporations): ?>
        <? foreach($j_corporations as $corporation): ?>
        <li class="asso_w clearfix">
            <div class="img_100 fl">
                <a href="/corporation/profile/<?=$corporation['id']?>" class="thumbnail">
                    <img src="<?=avatar_url($corporation['avatar'], 'corporation', 'big')?>" />
                </a>
            </div>
            <div class="asso_brief fl">
                <h4 class="asso_name"><a href="/corporation/profile/<?=$corporation['id']?>" class="a3"><?=$corporation['name']?></a></h4>
                <p class="c9"><?=$corporation['school'][0]['name']?> | 社长：<a href="/personal/profile/<?=$corporation['user'][0]['id']?>"><?=$corporation['user'][0]['name']?></a></p>
                <p class="c6"><?=$corporation['comment']?></p>
                <div class="asso_handle">
                    <a type="button" href="/corporation/setting/<?=$corporation['id']?>" class="btnDefault btnBlue" >管理社团</a>
                </div>
            </div>
        </li>
        <? endforeach ?>
        <? endif ?>
        <? if($f_corporations): ?>
        <? foreach($f_corporations as $corporation): ?>
        <li class="asso_w clearfix">
            <div class="img_100 fl">
                <a href="/corporation/profile/<?=$corporation['id']?>" class="thumbnail">
                    <img src="<?=avatar_url($corporation['avatar'], 'corporation', 'big')?>" />
                </a>
            </div>
            <div class="asso_brief fl">
                <h4 class="asso_name"><a href="/corporation/profile/<?=$corporation['id']?>" class="a3"><?=$corporation['name']?></a></h4>
                <p class="c9"><?=$corporation['school'][0]['name']?> | 社长：<a href="/personal/profile/<?=$corporation['user'][0]['id']?>"><?=$corporation['user'][0]['name']?></a></p>
                <p class="c6"><?=$corporation['comment']?></p>
                <div class="asso_handle">
                    <a type="button" href="/corporation/setting/<?=$corporation['id']?>" class="btnDefault btnBlue" >管理社团</a>
                </div>
            </div>
        </li>
        <? endforeach ?>
        <? endif ?>
    </ul>
    <h3>全校社团</h3>
    <? if($message): ?>
    <?=$message?>
    <? endif ?>
    <ul class="thumbnails">
        <? if($school_corporations): ?>
        <? foreach($school_corporations as $corporation): ?>
        <li class="asso_w clearfix">
            <div class="img_100 fl">
                <a href="/corporation/profile/<?=$corporation['id']?>" class="thumbnail">
                    <img src="<?=avatar_url($corporation['avatar'], 'corporation', 'big')?>" />
                </a>
            </div>
            <div class="asso_brief fl">
                <h4 class="asso_name"><a href="/corporation/profile/<?=$corporation['id']?>" class="a3"><?=$corporation['name']?></a></h4>
                <p class="c9">社长：<a href="/personal/profile/<?=$corporation['user'][0]['id']?>"><?=$corporation['user'][0]['name']?></a></p>
                <p class="c6"><?=$corporation['comment']?></p>
                <div class="asso_handle">
                    <a type="button" href="/corporation/setting/<?=$corporation['id']?>" class="btnDefault btnBlue" >管理社团</a>
                </div>
            </div>
        </li>
        <? endforeach ?>
        <? endif ?>
    </ul>
</div>