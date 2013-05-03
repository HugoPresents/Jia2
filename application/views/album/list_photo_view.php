<script type="text/javascript">

$(function() {
	$(".photo_option .set_cover").click(function() {
		action = 'cover';
		photo_id = $(this).attr('photo_id');
		anchor = $(this);
		$.post(
			SITE_URL + 'album/edit_photo', {
				ajax: 1,
				action: action,
				id: photo_id
			}, function(data) {
				if(data.success == '1') {
					$('.album_cover').text('设为相册封面').addClass('set_cover').removeClass('album_cover');
					anchor.removeClass('set_cover').addClass('album_cover').text('相册封面');
				} else {
					alert(data.message);
				}
			}, 'json'
		)
	});
})

</script>

<div class="mainContainer">
    <div class="container whiteBg">
<h4 class="title_01 title_02"><span>相册</span><?=$crumb ?></h4>
<div class="main_02">
	<h2><?=$info['name'] ?></h2>
	<div id="page">
		<div id="images">
			<ul class="gallery">
				<? if(isset($photos) && is_array($photos)): ?>
					<? foreach($photos as $photo): ?>
						<div class="photo_area">
						<a href="<?=base_url($photo['original'])?>" photo_id="<?=$photo['id'] ?>" rel="lightbox[gallery]" title="图片描述。。。">
						<li class="image_area"><img src="<?=base_url($photo['thumb'])?>" alt="description" />
						</li>
						</a>
						<div class="photo_option">
						<? if($info['cover_id'] == $photo['id']): ?>
							<a class="album_cover" id="<?=$photo['id']?>">相册封面</a>
						<? elseif($edit_access): ?>
							<a class="set_cover" photo_id="<?=$photo['id'] ?>">设为相册封面</a>
						<? endif ?>
						</div>
						</div>
					<? endforeach ?>
				<? endif ?>
			</ul>
		</div>
	</div>
</div>
</div>
</div>