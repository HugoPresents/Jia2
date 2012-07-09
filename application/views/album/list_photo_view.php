<script type="text/javascript">
/*
$(function() {
	$(".lb-caption").click(function() {
		title = $(this).text();
		id = $(this).attr('pid');
		$(this).hide();
		str = '<input type="text" name="title" value="' + title + '">';
		$(this).before(str);
		$("input[name='title']").focus();
		$("input[name='title']").blur(function() {
			changed = $(this).val();
			if(changed != title && changed != '') {
				$.post(SITE_URL + 'album/edit_photo', {
					id: id,
					title: changed
				}, function(data) {
					if(data == '1') {
						$("input[name='title']").remove();
						$("#image_title").text(changed).show();
					} else {
						alert('修改失败');
						$("input[name='title']").remove();
						$("#image_title").show();
					}
				});
			} else {
				$("input[name='title']").remove();
				$("#image_title").show();
			}
		});
	});
})
*/
</script>
<h4 class="title_01 title_02"><span>图片列表</span><?=$profile_a . '->' . $back_a ?></h4>
<div class="main_02">
	<h2><?=$info['name'] ?></h2>
	<div id="page">
		<div id="images">
			<ul class="gallery">
				<? if(isset($photos) && is_array($photos)): ?>
					<? foreach($photos as $photo): ?>
						<a href="<?=base_url($photo['original'])?>" photo_id="<?=$photo['id'] ?>" rel="lightbox[gallery]" title="图片描述。。。">
						<li class="image_area"><img src="<?=base_url($photo['thumb'])?>" alt="description" />
							
						</li>
						<? if($info['cover_id'] == $photo['id']): ?>
								<a style="color: red" class="photo_option">相册封面</a>
							<? else: ?>
								<a class="photo_option action" href="#">设为相册封面</a>
							<? endif ?>
						</a>
					<? endforeach ?>
				<? endif ?>
			</ul>
		</div>
	</div>
</div>