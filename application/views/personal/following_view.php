<h4 class="title_01 title_02"><span>管理</span><?=$crumb ?></h4>
<div  class="main_02">
<div id="" class="search_result flow_result">
<h4>我的关注 <span><?=$following_num?>个</span></h4>
<ul id="user-result">
	<? if(isset($following)):?>
	<? foreach($following as $row):?>
	<li>
		<?=anchor('personal/profile/' . $row['id'], '<img src="' . avatar_url($row['avatar'], 'personal', 'big') . '">', 'class="head_pic"')?>
		<div class="li_mbox">
			<h3><?=anchor('personal/profile/' . $row['id'], $row['name'])?></h3>
			<p><?=$row['gender'] == 1 ? '男' : '女'?></p>
			<p><?=$row['province'][0]['name'] ?></p>
			<p><?=$row['school'][0]['name'] ?></p>
		</div>
		<div>
			<?=form_button('unfollow', '取消关注', 'user_id="'.$row['id'].'"') ?>
		</div>
	</li>
	<? endforeach?>
	<div class="pagination">
	<?=$pagination ?>
	</div>
	<? endif?>
</ul>
</div>
</div>