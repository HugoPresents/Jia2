<? if(!empty($messages)): ?>
	<ul>
		<? foreach($messages as $message): ?>
			<li class="mes_li">
				<div class="left">
				<?=anchor('personal/profile/' . $message['user'][0]['id'], '<img src="'. avatar_url($message['user'][0]['avatar']) .'" >','class="head_pic"') ?>
				</div>
				<div class="left">
				<?=anchor('personal/profile/' . $message['user'][0]['id'],$message['user'][0]['name'])?>
				<?=$message['content'] ?>
				<?=jdate($message['time']) ?>
				</div>
			</li>
		<? endforeach ?>
	</ul>
<? endif ?>
</div>