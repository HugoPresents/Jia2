<script>
	window.onload = cotab;
</script>
<div id="main">
	<a href="<?=site_url('corporation/request_add') ?>" class="creat_button button"><i>+</i> 申请创建社团</a>
	<span><?=anchor('corporation/list_by_school', '查看全校社团','class="creat_button btn_01"') ?></span>
	<div id="search_box">
		<div id="search-bar">
			<?=form_open('search') ?>
			<?=form_hidden('offset', 0) ?>
			<?=form_hidden('corporation', 1) ?>
			<?=form_input('keywords','','class="serch_input" id="in_search_content"')?>
			<?=form_submit('submit', '搜索','class="btn-blue" id="in_search"')?>
			<?=form_close() ?>
		</div>
	</div>
	<div class="search_item">
		<ul>
			<li class="sd01" id="co-1">
				<a href="#" id="active">我的社团&nbsp;(<?=$j_num ?>)</a>
			</li>
			<li class="sd02" id="co-2">
				<a href="#">我关注的社团&nbsp;(<?=$f_num ?>)</a>
			</li>
		</ul>
	</div>
	<div id="feeds_container" class="feeds">
	<ul id="feed_1">
		<? if(!empty($j_corporations)): ?>
			<? foreach($j_corporations as $corporation):?>
				<li class="feed_a">
					<div class="img_block"><img src="<?=avatar_url($corporation['avatar'], 'corporation', 'big') ?>" /></div>
						<div class="feed_main">
						<h3 class="asso_name"><a href="<?=site_url('corporation/profile/' . $corporation['id'])?>"><?=$corporation['name'] ?></a></h3>
						<ul class="asso_ul">
							<li><a><?=$corporation['comment'] ?></a></li>
						</ul>
					</div>
				</li>
			<? endforeach?>
		<? else: ?>
			<p> 还没有加入社团？ 赶紧搜索一个或者<?=anchor('corporation/list_all', '查看全部社团') ?></p>
		<? endif ?>
			
		</li>
	</ul>
	<ul id="feed_2" class="hidden">
		<? if(!empty($f_corporations)): ?>
			<? foreach($f_corporations as $corporation):?>
				<li class="feed_a">
					<div class="img_block"><img src="<?=avatar_url($corporation['avatar'], 'corporation', 'big') ?>" /></div>
						<div class="feed_main">
						<h3 class="asso_name"><a href="<?=site_url('corporation/profile/' . $corporation['id'])?>"><?=$corporation['name'] ?></a></h3>
						<ul class="asso_ul">
							<li><a><?=$corporation['comment'] ?></a></li>
						</ul>
					</div>
				</li>
			<? endforeach?>
		<? else: ?>
			<p> 还没有关注社团？ 赶紧搜索一个或者<?=anchor('corporation/list_all', '查看全部社团') ?></p>
		<? endif ?>
	</ul>
	</div>
	</div>	
</div>
