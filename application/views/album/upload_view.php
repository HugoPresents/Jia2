<h4 class="title_01 title_02"><span>上传照片</span><?=$profile_a . '->' . $back_a ?></h4>
<div class="main_02">
	<p class="p_1">	支持JPG、JPEG、GIF和PNG文件，最大2M。	</p>
	<?=form_open_multipart('') ?>		
	<div href="" class="btn-blue">
		浏览
		<?=form_upload('userfile') ?>
	</div>
	<div class="photo_target"><span>请选择相册：</span><?=form_dropdown('album', $albums_id) ?></div>
	<p><?=form_submit('submit', '上传','class="pub_button file_btn"') ?></p>
	<?=form_close() ?>
</div>