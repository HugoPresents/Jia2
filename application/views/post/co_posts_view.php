<? if(!empty($posts['activity'])):?>
<? foreach ($posts['activity'] as $post):?>
<div class="feed_a clearfix">
    <div class="img_block fl">
      <?=anchor('corporation/profile/' . $post['corporation'][0]['id'], '<img onerror="onImgError(this);" src="'. avatar_url($post['corporation'][0]['avatar']) .'" >','class="head_pic"') ?>
    </div>
    <div class="feed_main">
      <div class="f_nick">
        <a href="<?=site_url('corporation/profile/' . $post['corporation'][0]['id']) ?>"><?=$post['corporation'][0]['name']?></a>
      </div>
      <div class="f_text"><?=convert_emoji($post['content'])?></div>
      <!-- 评论等toolbar-->
      <div class="f_summary clearfix">
        <div class="fl"><span><?=time2duration($post['time'])?></span> 来自 <span><?=$post['corporation'][0]['school'][0]['name']?></span></div>
          <div class="fr">
             <a href="javascript:;" class="CommetBtn">评论(<span class="comments_total"><?=$post['comments']?></span>)</a>
          </div>
      </div>
      <div class="repeat">
        <span class="arr">
          <span class="arr_out"></span>
          <span class="arr_in"></span>
        </span>
       <? if($this->session->userdata('type') != 'guest'): ?>
        <!-- 评论框  -->
        <div class="comment_wrap">
          <textarea class="W_input" post_id="<?=$post['id']?>"></textarea>
          <p class="btn_wrap clearfix"><button name="comment" type="button" class="W_btn fl">评论</button></p>
        </div>
        <? else: ?>
        <?=anchor('index/login?jump=' . uri_string(), '登录后才能发表评论') ?>
        <? endif ?>
        <div class="comment_lists">
        <? if(count($post['comment']) > 0): ?>
		<?foreach($post['comment'] as $comment):?>
              <dl class="comment_list">
                <dt><a href="/personal/profile/<?=$comment['user'][0]['id']?>"><img src="<?=avatar_url($comment['user'][0]['avatar'])?>" class="img30"></a></dt>
                <dd><a href="/personal/profile/<?=$comment['user'][0]['id']?>"><?=$comment['user'][0]['name']?></a>&nbsp;&nbsp;<?=$comment['content']?> <br><?=time2duration($comment['time'])?></dd>
              </dl>
          <? endforeach; ?>
          		  <? if($post['comments'] > count($post['comment'])): ?>
		          	后面还有<?=$post['comments']-count($post['comment'])?>条评论<?=anchor('post/' . $post['id'], '点击查看>>') ?>
		          <? endif ?>
          <? endif ?>
        </div>
      </div>
    </div>
</div>
<? endforeach ?>
<? endif ?>