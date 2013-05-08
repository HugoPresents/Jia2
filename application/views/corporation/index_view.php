<header class="subhead subheadline">
    <div class="container"></div>
</header>
<div class="container mainBody">
    <div class="mt20 clearfix feed_switcher ">
        <div class="btn-group">
        <?
        $first = FALSE;
        $active = FALSE;
        if($m_corporations): ?>
        <a title="我管理的社团" href="#manage" id="" class="switch<?= $first ? '':' first selected'?> btn"  data-toggle="tab">我管理的社团</a>
        <? $first = TRUE;$active = 'm';endif ?>
        <? if($j_corporations): 
        ?>
        <a title="我参加的社团" href="#join" id="" class="switch<?= $first ? '':' first selected'?> btn"  data-toggle="tab">我参加的社团</a>
        <? $first = TRUE;$active = $active ? $active : 'j';endif ?>
        <? if($f_corporations): ?>
        <a title="我关注的社团" href="#atten" id="" class="switch<?= $first ? '':' first selected'?> btn"  data-toggle="tab">我关注的社团</a>
        <? $first = TRUE;$active = $active ? $active : 'f';endif ?>
        </div>
        <div class="feed_op">
            <a href="<?=site_url('corporation/request_add') ?>" target="_blank" class="btnDefault" >创建社团</a>
            <a href="/search/?target=corporation" target="_blank" class="btnDefault btnBlue" >发现社团</a>
        </div>
    </div>
    <div class="tab-content">
    <ul class="asso_mg tab-pane<?=$active == 'm' ? ' active':''?>" id="manage">
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
    </ul><ul class="asso_mg tab-pane<?=$active == 'j' ? ' active':''?>" id="join">
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
            </div>
        </li>
        <? endforeach ?>
        <? endif ?>
    </ul><ul class="asso_mg tab-pane<?=$active == 'f' ? ' active':''?>" id="atten">
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
            </div>
        </li>
        <? endforeach ?>
        <? endif ?>
    </ul>
    </div>
    <h3>全校社团</h3>
    <? if($message): ?>
    <?=$message?>
    <? endif ?>
    <ul class="thumbnails">
        <? if($school_corporations): ?>
        <? foreach($school_corporations as $corporation): ?>
                <li class="span3">
                    <a class="thumbnail"  href="/corporation/profile/<?=$corporation['id']?>">
                        <img src="<?=avatar_url($corporation['avatar'], 'corporation', 'big')?>">
                        <p class="asso_tit"><?=$corporation['name']?></p>
                    </a>
                </li>
        <? endforeach ?>
        <? endif ?>
    </ul>
</div>
<script type="text/javascript" src="<?= base_url('resource/js/new/tab.js') ?>"></script>
<script>
    $(function () {
        $('.switch').click(function (e) {
            $(".switch").removeClass("selected");
            $(this).addClass("selected");
            e.preventDefault();
            $(this).tab('show');
        });
    });
</script>
