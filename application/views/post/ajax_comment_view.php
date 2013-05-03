<dl class="comment_list">
                <dt>
                	<?=anchor('personal/profile/' . $comment['user'][0]['id'], '<img src="'. avatar_url($comment['user'][0]['avatar']) .'" >','class="img30"') ?>
                </dt>
                <dd>
                	<?=anchor('personal/profile/' . $comment['user'][0]['id'], $comment['user'][0]['name']) ?>
                	<?=$comment['content']?> 
                	<br>
                	<?=time2duration($comment['time'])?>
                </dd>
              </dl>