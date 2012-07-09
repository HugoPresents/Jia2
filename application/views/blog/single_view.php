<h4 class="title_01 title_02"><span><?=anchor('blog', '日志') ?></span>
	<?=$back_a ?> -> <?=anchor('blog/view/' . $blog['id'], $blog['title']) ?></h4>
<div class="main_02">
	<div class="article">
		<h2 class="hd"><?=$blog['title']?></h2>
		<div class="ht">
			<span><?=jdate($blog['add_time'], FALSE) ?></span>
			<?=anchor('blog/edit/' . $blog['id'], '编辑') ?>
		</div>
		<div class="bd">
			<?=$blog['content'] ?>
		</div>
	</div>
</div>