<div class="mainContainer">
    <div class="container whiteBg">
    	<h4 class="title_01 title_02"><span>日志</span><?=$crumb ?></h4>
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

</div>
</div>