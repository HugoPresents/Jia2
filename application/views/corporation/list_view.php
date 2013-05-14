<header class="subhead subheadline">
    <div class="container">
    </div>
</header>
<div class="container mainBody">
    <div class="mt20 clearfix feed_switcher btn-group">
    	<? 
    	$corporation_tags = $this->config->item('corporation_tags');
    	foreach($tags as $tag):?>
    	<a tag_id="<?=$tag['meta_value']?>" href="javascript:void(0);" class="switch btn tag_selector"><?=$corporation_tags[$tag['meta_value']]?></a>
    	<? endforeach; ?>
    </div>
    <div class="loading">
        <img src="/resource/img/loading.gif" /><span>正在加载，请稍候...</span>
    </div>
    <ul class="asso_wrap clearfix" id="corporation_list">
    </ul>
</div>
<script type="text/javascript">
	$(function() {
		$('.tag_selector').click(function() {
			$(".switch").removeClass("selected");
            $(this).addClass("selected");
			var tag = $(this).attr('tag_id');
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
