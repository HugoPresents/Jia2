<? if($requests): ?>
<script>
	$(function() {
		$(".col-c").click(function() {
			$comments = $(this).parent().parent().parent().next();
			$comments.slideToggle();
		});
	});
</script>
<? foreach($requests as $request): ?>
<li class="feed_a">
<div class="img_block">
	<?=anchor('personal/profile/' . $request['user'][0]['id'], '<img src="'. avatar_url($request['user'][0]['avatar']) .'" >','class="head_pic"') ?>
</div>
<div class="feed_main">
	<div class="f_info">
		<a href="<?=site_url('personal/profile/' . $request['user'][0]['id']) ?>"><?=$request['user'][0]['name']?></a>&nbsp;申请创建&nbsp;<?=$request['co_name'] ?>&nbsp;社团
	</div>
	<div class="f_summary">
		<p class="f_pm">
			<span><?=jdate($request['time']) ?></span>
			<span><a class="col-c">查看详情</a></span>
		</p>
	</div>
	<div class="feeds_comment_box hidden">
		<p>社团名：<?=$request['co_name'] ?></p>
		<p>身份证号：<?=$request['id_card_number'] ?></p>
		<p>身份证：</p>
		<p><img src="<?=card_cap($request['id_card_cap']) ?>"></p>
		<p>学号：<?=$request['st_card_number'] ?></p>
		<p>学生证：</p>
		<p><img src="<?=card_cap($request['st_card_cap']) ?>"></p>
		<p>备注：</p>
		<p><?=$request['comment'] ?></p>
		<p><?=anchor('admin/admin/co_request/' . $request['id'] . '?pass=yes', '通过申请') ?>&nbsp;&nbsp;<?=anchor('admin/admin/co_request/' . $request['id'] . '?pass=no', '拒绝申请') ?></p>
	</div>
	</div>
</li>
<? endforeach ?>
<? else: ?>
<p>暂时没有未处理请求</p>
<? endif ?>