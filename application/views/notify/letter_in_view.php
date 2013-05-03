<?
	/*
	 * 收件箱视图
	 */
?>
<div id="letter_in_content">
<? if(!empty($letters)): ?>
	<ul>
	<? foreach($letters as $letter): ?>
		<li class="mes_li">
			<div class="fl">
				<?=anchor('personal/profile/' . $letter['user'][0]['id'], '<img src="'. avatar_url($letter['user'][0]['avatar']) .'" >','class="head_pic"') ?>
				</div>
				<div class="fl">
				<?=anchor('personal/profile/' . $letter['user'][0]['id'],$letter['user'][0]['name'])?>
				<?=$letter['content'] ?>
				<?=jdate($letter['time']) ?>
				</div>
		</li>
	<? endforeach ?>
	</ul>
<?else: ?>
<p>收件箱为空</p>
<? endif?>
</div>
