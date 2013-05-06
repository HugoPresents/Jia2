<?
/*
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
 */
?>
<header class="subhead subheadline">
    <div class="container">
    </div>
</header>
<div class="container mainBody">
    <div class="mt20 clearfix feed_switcher">
    	<? foreach($tags as $tag):?>
    	<a title="<?=$tag['meta_value']?>" href="javascript:void(0);" id="" class="tag_selector"><?=$tag['meta_value']?></a>
    	<? endforeach; ?>
    </div>
    <div class="loading">
        <img src="img/loading.gif"/><span>正在加载，请稍候...</span>
    </div>
    <ul class="asso_wrap clearfix" id="corporation_list">
    </ul>
</div>
<script type="text/javascript">
	$(function() {
		$('.tag_selector').click(function() {
			var tag = $(this).attr('title');
			load_corporations(tag);
		});
		$('.tag_selector:first').trigger('click');
	});
	
	function load_corporations(tag) {
		$('.loading').show();
		var list = $('#corporation_list');
		list.empty();
		$.post(
			'/corporation/list_by_tag',
			{
				tag : tag,
				ajax : 1
			},
			function(data) {
				list.append(data);
				$('.loading').hide();
			}
		);
	}
</script>
