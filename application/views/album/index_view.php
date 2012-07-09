<h4 class="title_01 title_02"><span><?=$info['name'] . '的相册' ?></span><?=$back_a ?>
</h4>
<div class="main_02">
	<a class="upload_photo_btn" href="<?=$upload_url ?>">上传照片</a>
	<a class="upload_photo_btn" href="<?=$create_url ?>">创建相册</a>
	<div class="photo_album_box">
		<div id="images">
			<ul class="gallery">
				<? if(isset($albums) && is_array($albums)): ?>
				<? foreach($albums as $album): ?>
					<a href="<?=site_url('album/lists/' . $album['id']) ?>">
					<li><img src="<?=cover_url($album['cover_id']) ?>" alt="description" /><p class="album_name"><?=$album['name'] ?></p>
					</li> </a>
				<? endforeach ?>
				<? else: ?>
					<p><?=$info['name'] ?>还没有相册，<?=anchor($create_url, '创建相册') ?></p>
				<? endif ?>
			</ul>
		</div>
	</div>
</div>