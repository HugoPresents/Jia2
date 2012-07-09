<? if(!empty($posts['personal'])):?>
<? foreach ($posts['personal'] as $post):?>
<li class="feed_a">
	<div class="img_block">
		<?=anchor('personal/profile/' . $post['user'][0]['id'], '<img src="'. avatar_url($post['user'][0]['avatar']) .'" >','class="head_pic"') ?>
	</div>
	<div class="feed_main">
		<div class="f_info">
			<a href="<?=site_url('personal/profile/' . $post['user'][0]['id']) ?>"><?=$post['user'][0]['name']?></a>
			<span class="f_do"><?=$post['content']?></span>
		</div>
		<div class="f_summary">
			<p class="f_pm">
				<span><?=jdate($post['time']) ?></span>
				<span><a class="col-c">收起评论</a></span>
			</p>
		</div>
			<div class="feeds_comment_box">
				<ul class="comment">
					<? if(!empty($post['comment'])):?>
					<? foreach($post['comment'] as $comment):?>
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
					<? endforeach?>
					<? endif?>
				</ul>
				<div class="extend_link">
				<? $a_link = site_url('post/' . $post['id']) ?>
				<? if(current_url() != $a_link): ?>
					<?=anchor('post/' . $post['id'], '查看全部评论>>') ?>
				<? endif ?>
				</div>
				<? if($this->session->userdata('type') != 'guest'): ?>
				<div class="comment_wrap">
						<table class="Textarea">
						<tbody>
							<tr>
								<td id="Textarea-tl"></td>
								<td id="Textarea-tm"></td>
								<td id="Textarea-tr"></td>
							</tr>
							<tr>
								<td id="Textarea-ml"></td>
								<td id="Textarea-mm" class="">
									<div>
										<?=form_textarea(array('name' => 'comment_content', 'post_id'=>$post['id'], 'type' => 'personal', 'cols' => 50, 'rows' =>1,'class'=>'comment_textarea')) ?>
									</div>
								</td>
								<td id="Textarea-mr"></td>
							</tr>
							<tr>
								<td id="Textarea-bl"></td>
								<td id="Textarea-bm"></td>
								<td id="Textarea-br"></td>
							</tr>
						</tbody>
					</table>
					<p><?=form_button('comment', '评论', 'class="pub_button comment_button"') ?></p>
				</div>
				<? else: ?>
				<?=anchor('index/login?jump=' . uri_string(), '登录后才能发表评论') ?>
				<? endif ?>
			</div>
		</div>
</li>		
<? endforeach ?>
<? endif ?>