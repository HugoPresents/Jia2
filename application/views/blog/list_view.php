<h4 class="title_01 title_02"><span>日志列表</span><?=$back_a . $post_a ?></h4>
<div class="main_02">
	<div class="dairy_summary">
		<ul>
			<? if($blogs): ?>
				<? foreach($blogs as $blog): ?>
					<li>
						<div class="article_item">
							<h4 class="hd"><?=anchor('blog/view/' . $blog['id'], $blog['title']) ?></h4>
							<div class="bd">
								<?=$blog['content'] ?>
							</div>
							<div class="ft">
								<span><?=jdate($blog['add_time'], FALSE) ?></span>
								<?=anchor('blog/view/' . $blog['id'], '查看全文') ?>
								<?=anchor('blog/edit/' . $blog['id'], '编辑') ?>
								<a href=""> 删除</a>
							</div>
						</div>
						<div class="article_shadow">
							<div class="bor2"></div>
						</div>
					</li>
				<? endforeach ?>
			<? endif ?>
		</ul>
	</div>
</div>