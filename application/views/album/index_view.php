<div class="mainContainer">
    <div class="container whiteBg">
    	<h4 class="title_01 title_02"><span>相册</span><?=$crumb ?>
</h4>
<div class="main_03">
	<a class="btn btn-info" href="<?=$upload_url ?>">上传照片</a>
	<a class="btn btn-info" href="<?=$create_url ?>">创建相册</a>
	<div class="photo_album_box">
		<div id="images">
			<ul class="gallery album">
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

</div>
</div>