<div id="set_head" class="active">
    <h4 class="set_title">设置协会头像</h4>
    <p class="p_1"> 支持JPG、JPEG、GIF和PNG文件，最大2M。  </p>
    <?=form_open_multipart('corporation/setting/' . $info['id']) ?>

    <span href="" class="btn-blue">
                浏览
        <?=form_upload('userfile','', 'class="file"') ?>
            </span>
    <?=form_hidden('setting', 'avatar') ?>
    <?=form_submit('submit', '上传','class="btn btn-info"') ?>
    <span id="filename">未选择文件</span>
    <?=form_close() ?>

    <h4 class="set_title">当前头像</h4>
    <img src="<?=avatar_url($info['avatar'], 'corporation', 'big') ?>" />
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