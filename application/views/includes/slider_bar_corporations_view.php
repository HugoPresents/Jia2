<?
  if($master_cos and count($master_cos) > 0): ?>
  <dl class="sidebar_nav">
    <dt>管理的社团（<?=count($master_cos)?>）</dt>
    <dd class="clearfix">
    <? foreach($master_cos as $corporation):?>
    <a class="a_sty_02" href="/corporation/profile/<?=$corporation['id']?>">
      <img src="<?=avatar_url($corporation['avatar'], 'corporation', 'big')?>" onerror="onImgError(this);"><br><?=$corporation['name']?>
    </a>
    <? endforeach ?>
    </dd>
  </dl>
  <? endif ?>
  <? if($join_cos and count($join_cos) > 0): ?>
  <dl class="sidebar_nav">
    <dt>加入的社团（<?=count($join_cos)?>）</dt>
    <dd class="clearfix">
    <? foreach($join_cos as $corporation):?>
    <a class="a_sty_02" href="/corporation/profile/<?=$corporation['id']?>">
      <img src="<?=avatar_url($corporation['avatar'], 'corporation', 'big')?>" onerror="onImgError(this);"><br><?=$corporation['name']?>
    </a>
    <? endforeach ?>
    </dd>
  </dl>
  <? endif ?>
  <? if($following_cos and count($following_cos) > 0): ?>
  <dl class="sidebar_nav">
    <dt>关注的社团（<?=count($following_cos)?>）</dt>
    <dd class="clearfix">
    <? foreach($following_cos as $corporation):?>
    <a class="a_sty_02" href="/corporation/profile/<?=$corporation['id']?>">
      <img src="<?=avatar_url($corporation['avatar'], 'corporation', 'big')?>" onerror="onImgError(this);"><br><?=$corporation['name']?>
    </a>
    <? endforeach ?>
    </dd>
  </dl>
  <? endif ?>