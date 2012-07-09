<ul>
<? if(!empty($requests)): ?>
	<? foreach($requests as $request): ?>
		<li class="mes_li">
			<div class="left">
			<?=anchor('personal/profile/' . $request['user'][0]['id'], '<img src="'. avatar_url($request['user'][0]['avatar']) .'" >','class="head_pic"') ?>
			</div>
			<div class="left">
			<?=anchor('personal/profile/' . $request['user'][0]['id'],$request['user'][0]['name'])?>
			<? $content = explode('|||', $request['content']) ?>
			<?=$content[0] ?>
			<?=jdate($request['time']) ?>
			</div><br>
			<div class="options">
				<a href="<?=$content[1] . '?request_id=' . $request['id'] ?>">同意加入</a>&nbsp;&nbsp;&nbsp;<a href="#" class="reject_request" request_id = <?=$request['id'] ?>>拒绝</a>
			</div>
		</li>
	<? endforeach ?>
</ul>
<? endif?>