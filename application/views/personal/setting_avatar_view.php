<div id="set_head" class="tab-pane active">
    <h4 class="set_title">提示</h4>
    <p>可能由于浏览器缓存的原因，你设置的头像没能及时更新，请尝试刷新页面查看新头像 ;)</p>
    <? if ($tmp_avatar): ?>
        <script language="Javascript">
            $(function () {
                $('#cropbox').Jcrop({
                    aspectRatio: 1,
                    setSelect: [ 0, 0, 180, 180 ],
                    onSelect: updateCoords
                });

            });

            function updateCoords(c) {
                $("input[name='crop_x']").val(c.x);
                $("input[name='crop_y']").val(c.y);
                $("input[name='crop_w']").val(c.w);
                $("input[name='crop_h']").val(c.h);
            }
            ;

            function checkCoords() {
                if (parseInt($('#w').val())) return true;
                alert('Please select a crop region then press submit.');
                return false;
            }
            ;

        </script>
        <div id="crop_avatar">
            <h4 class="set_title">剪裁头像</h4>

            <p>你已经上传了头像，请剪裁至合适尺寸，你也可以在下面上传新的图片</p>
            <img src="<?= $tmp_avatar ?>" id="cropbox"/>
            <?=form_open('personal/do_setting') ?>
            <?=form_hidden('crop_x') ?>
            <?=form_hidden('crop_y') ?>
            <?=form_hidden('crop_w') ?>
            <?=form_hidden('crop_h') ?>
            <?=form_hidden('setting', 'avatar') ?>
            <?=form_hidden('target', 'tmp') ?>
            <?=form_submit('delete', '取消', 'class="pub_button"') ?>
            <?=form_submit('submit', '剪裁', 'class="pub_button"') ?>
            <?=form_close() ?>
        </div>
    <? endif ?>
    <h4 class="set_title">设置新头像</h4>

    <p class="p_1"> 支持JPG、JPEG、GIF和PNG文件，最大2M。 </p>
    <?=form_open_multipart('personal/do_setting') ?>
    <span href="" class="btn-blue">
                浏览
        <?=form_upload('userfile', '', 'id="userfile"') ?>
            </span>
    <?=form_hidden('setting', 'avatar') ?>
    <?=form_submit('', '上传', 'class="pub_button file_btn" id="upload_avatar"') ?>
    <span id="filename">未选择文件</span>
    <?=form_close() ?>

    <h4 class="set_title">当前头像</h4>
    <img src="<?= avatar_url($info['avatar'], 'personal', 'big') ?>"/>
</div>