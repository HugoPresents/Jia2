<!--
<pre>
<?=print_r($info) ?>
</pre>
-->
<h4 class="title_01 title_02"><span>活动详细</span><?=anchor('corporation/profile/' . $info['corporation'][0]['id'], '返回' . $info['corporation'][0]['name']) ?></h4>
<div class="main_02">
	<h2 class="ac_title"><?=anchor('corporation/profile/' . $info['corporation'][0]['id'], $info['corporation'][0]['name']) . ' 的' . $info['user'][0]['name'] . '童鞋发起了 ' . $info['name']?></h2>
	<div class="ac_01">
		<h3>活动时间</h3>
		<p>
			<?=jdate($info['start_time']) . '-' . jdate($info['deadline'])?>
		</p>
	</div>
	<div class="ac_01">
		<h3>活动地点</h3>
		<p>
			<?=$info['address']?>
		</p>
	</div>
	<h3>活动详情</h3>
	<div class="ac_01">
		<p>
			<?=$info['detail']?>
		</p>
		<div class="admin-options"></div>
		<?=anchor('activity/edit/' . $info['id'], '编辑活动')?>
	</div>
</div>