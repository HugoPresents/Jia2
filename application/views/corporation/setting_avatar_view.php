<div id="set_head" class="active">
    <h4 class="set_title">设置协会头像</h4>
    <p class="p_1"> 支持JPG、JPEG、GIF和PNG文件，最大2M。  </p>
    <?=form_open_multipart('corporation/setting/' . $info['id']) ?>

    <span href="" class="btn-blue">
                浏览
        <?=form_upload('userfile') ?>
            </span>
    <?=form_hidden('setting', 'avatar') ?>
    <?=form_submit('submit', '上传','class="pub_button file_btn"') ?>
    <?=form_close() ?>

    <h4 class="set_title">当前头像</h4>
    <img src="<?=avatar_url($info['avatar'], 'corporation', 'big') ?>" />
</div>