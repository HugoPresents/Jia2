<li>
    <div class="img_block"><?=anchor('personal/profile/' . $comment['user'][0]['id'], '<img src="'. avatar_url($comment['user'][0]['avatar']) .'" >','class="head_pic"') ?></div>
    <div class="comment_main">
        <div class="f_info">
        <?=anchor('personal/profile/' . $comment['user'][0]['id'], $comment['user'][0]['name']) ?>：
        <span class="f_do"><?=$comment['content']?></span>
    </div>
    <p class="f_pm">
        <span><?=jdate($comment['time']) ?></span>
    </p>
    </div>
</li>