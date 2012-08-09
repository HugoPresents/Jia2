<script>
$(function(){
	$(".Checked").toggle(function(){
			$(this).removeClass("Checked").addClass("Checkbox");
			$(this).children().removeAttr('checked');
		},function(){
			$(this).removeClass("Checkbox").addClass("Checked");
			$(this).children().attr("checked", "checked");
		})
	$(".Checkbox").toggle(function(){
			$(this).removeClass("Checkbox").addClass("Checked");
			$(this).children().attr("checked", "checked");
		},function(){
			$(this).removeClass("Checked").addClass("Checkbox");
			$(this).children().removeAttr('checked');
		})
})
</script> 
<div id="main">
	<h3>&nbsp;搜索&nbsp;<span id="searh_key">“<?=trim($this->input->post('keywords')) ?>”</span></h3>
	<div id="search_box">
		<div id="search-bar">
			<?=form_open('search') ?>
			<?=form_hidden('offset', 0) ?>
			<?=form_input('keywords','','class="serch_input" id="in_search_content"')?>
			<?=form_submit('submit', '搜索','class="btn-blue" id="in_search"')?>
		</div>
	</div>
	<p id="chose_box">
		<span class="CheckboxWrapper Checked">
			<input type="checkbox" name="user" value="1" class="chbox" checked="checked"/>
		</span>
		<span class="Checkitem">用户</span>
		<span class="CheckboxWrapper Checkbox">
			<input type="checkbox" name="corporation" value="1" class="chbox"/>
		</span>
		<span class="Checkitem">社团</span>
		<span class="CheckboxWrapper Checkbox">
			<input type="checkbox" name="activity" value="1" class="chbox"/>
		</span>
		<span class="Checkitem">活动</span>
	</p>
		<?=form_close() ?>
	<div class="search_item">
			<ul>
				<li class="sd01" id="01">
					<a href="#" id="active">搜索结果&nbsp;</a>
				</li>
			</ul>
	</div>
	<div id="search_result_01" class="search_result">
		<? if(isset($user_result)): ?>
		<h4>人名 <span><?=$user_rows?>条结果</span></h4>
		<ul id="user-result">
			<? if(isset($user_result)):?>
			<? foreach($user_result as $row):?>
			<li>
				<?=anchor_popup('personal/profile/' . $row['id'], '<img src="' . avatar_url($row['avatar'], 'personal', 'big') . '">', 'class="head_pic"')?>
				<div class="li_mbox">
					<h3><?=anchor_popup('personal/profile/' . $row['id'], $row['name'])?></h3>
					<p><?=$row['gender'] == 1 ? '男' : '女'?></p>
					<p><?=$row['province'][0]['name'] ?></p>
					<p><?=$row['school'][0]['name'] ?></p>
				</div>
			</li>
			<? endforeach?>
			<? endif?>
		</ul>
		<? endif ?>
		<? if(isset($corporation_result)): ?>
		<h4>社团 <span><?=$corporation_rows?>条结果</span></h4>
		<ul id="corporation-result">
			<? if(isset($corporation_result)):?>
			<? foreach($corporation_result as $row):?>
			<li>
				<?=anchor_popup('corporation/profile/' . $row['id'], '<img src="' . avatar_url($row['avatar'], 'corporation', 'big') . '">', 'class="head_pic"')?>
				<div class="li_mbox">
					<h3><?=anchor_popup('corporation/profile/' . $row['id'], $row['name'])?></h3>
				</div>
			</li>
			<? endforeach?>
			<? endif?>
		</ul>
		<? endif ?>
		<? if(isset($activity_result)): ?>
		<h4>活动 <span><?=$activity_rows?>条结果</span></h4>
		<ul id="activity-result">
			<? if(isset($activity_result)):?>
			<? foreach($activity_result as $row):?>
			<li>
				<?=anchor_popup('activity/view/' . $row['id'], '<img src="' . avatar_url($row['corporation'][0]['avatar'], 'corporation', 'big') . '">', 'class="head_pic"')
				?>
				<div class="li_mbox">
					<h3><?=anchor_popup('activity/view/' . $row['id'], $row['name'])
					?></h3>
				</div>
			</li>
			<? endforeach?>
			<? endif?>
		</ul>
		<? endif ?>
	</div>