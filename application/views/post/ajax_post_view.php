<div class="feed_a clearfix">
    <div class="img_block fl">
      <?=anchor('personal/profile/' . $post['user'][0]['id'], '<img src="'. avatar_url($post['user'][0]['avatar']) .'" >','class="head_pic"') ?>
    </div>
    <div class="feed_main">
      <div class="f_nick">
        <a href="<?=site_url('personal/profile/' . $post['user'][0]['id']) ?>"><?=$post['user'][0]['name']?></a>
      </div>
      <div class="f_text"><?=convert_emoji($post['content'])?></div>
      <!-- 评论等toolbar-->
      <div class="f_summary clearfix">
        <div class="fl"><span><?=time2duration($post['time'])?></span> 来自 <span>成都信息工程学院</span></div>
          <div class="fr"><a href="javascript:;" class="CommetBtn">评论</a></div>
      </div>
      <div class="repeat">
        <span class="arr">
          <span class="arr_out"></span>
          <span class="arr_in"></span>
        </span>
        <!-- 评论框  -->
        <div class="comment_wrap">
          <textarea class="W_input"></textarea>
          <p class="btn_wrap clearfix"><button name="post" type="button" class="W_btn fl">评论</button></p>
        </div>
        <div class="comment_lists">
        <? if(count($post['comment']) > 0): ?>
		<?foreach($post['comment'] as $comment):?>
              <dl class="comment_list">
                <dt><a href=""><img src="img/img30.jpeg" class="img30"></a></dt>
                <dd><a href=""><?=$comment['user'][0]['name']?></a><?=$comment['content']?> <br><?=time2duration($comment['time'])?></dd>
              </dl>
          <? endforeach; ?>
          <? endif ?>
        </div>
      </div>
    </div>
</div>
