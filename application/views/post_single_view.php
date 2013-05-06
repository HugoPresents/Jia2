<? if(!empty($posts['activity'])): ?>
<h4 class="title_01 title_02"><span>动态</span><?=anchor('corporation/profile/' . $posts['activity'][0]['corporation'][0]['id'], $posts['activity'][0]['corporation'][0]['name'] . '的动态') ?></h4>
<div id="main">
		<div class="post_main">
	<? $this->load->view('post/co_posts_view') ?>
<? else: ?>
<h4 class="title_01 title_02"><span>动态</span><?=anchor('personal/profile/' . $posts['personal'][0]['user'][0]['id'], $posts['personal'][0]['user'][0]['name'] . '的动态') ?></h4>
<div id="main">
	<div class="post_main">
	<? $this->load->view('post/user_posts_view') ?>
<? endif ?>
	</div>
</div>
<script type="text/javascript">
	$(function() {
		$('.CommetBtn').trigger('click');
	});
</script>