<div class="mainContainer">
    <div class="container whiteBg">
    	<h4 class="title_01 title_02"><span>相册</span><?=$crumb ?></h4>
<div class="main_02">
	<p class="p_1">	支持JPG、JPEG、GIF和PNG文件，最大2M。	</p>
	<?=form_open_multipart('') ?>		
	<div href="" class="btn-blue">
		浏览
		<?=form_upload('userfile','', 'class="file"') ?>
	</div>
    <span id="filename">未选择文件</span>
	<div class="photo_target"><span>请选择相册：</span><?=form_dropdown('album', $albums_id) ?></div>
	<p><?=form_submit('submit', '上传','class="btn btn-info"') ?></p>
	<?=form_close() ?>
</div>
</div>
</div>
<script type="text/javascript">
    $(".file").change(function() {
        path = $(this).val();
        if(path.length < 1) {
            $("#filename").html('未选择文件');
            return;
        }
        fileName = path.substring(path.lastIndexOf('\\')+1,path.lastIndexOf('.'));
        $("#filename").html(fileName);
    });
</script>