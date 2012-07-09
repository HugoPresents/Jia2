<h4 class="title_01"><?=$title ?></h4>
<div  class="tab_cont_box content_1">
	<div id="a1">
		<ul id="corporation-result">
			<? if(!empty($corporations)):?>
			<? foreach($corporations as $row):?>
			<li class="box_1">
				<a><?=anchor('corporation/profile/' . $row['id'], '<img src="' . avatar_url($row['avatar'], 'corporation', 'big') . '">', 'class="head_pic"')?></a>
				<h3><?=anchor('corporation/profile/' . $row['id'], $row['name'])?></h3>
				<p><?=$row['comment'] ?></p>
			</li>
			<? endforeach?>
			<? endif?>
		</ul>
	</div>
</div>