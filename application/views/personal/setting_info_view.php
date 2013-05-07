<div id="account" class="tab-pane active">
    <h4 class="set_title"><span><?=$info['name'] ?></span>，你好！<a id="modify" href="#" class="fr">修改</a></h4>
    <ul id="user_info">
        <li class="li_1">姓名：<span><?=$info['name'] ?></span></li>
        <li class="li_1">性别：<span><?=$info['gender'] == 1 ? '男' : '女' ?></span></li>
        <li class="li_1">学校：<span><?=$info['school'][0]['name']?></span></li>
        <li class="li_1">省份：<span><?=$info['province'][0]['name']?></span></li>
    </ul>

    <ul id="user_info_form" style="display:none">
        <?=form_open('personal/do_setting', 'class="form-horizontal"')?>
        <?=form_hidden('setting', 'info') ?>
        <div class="control-group">
            <label class="control-label" for="inputEmail">姓名：</label>

            <div class="controls">
                <?=form_input('name', $info['name']) ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">性别：</label>

            <div class="controls">
                <?=form_dropdown('gender', array('1' => '男', '0' => '女'), 'class="SelectWrapper"') ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">生日：</label>

            <div class="controls">
                <?=form_input('birthday', date('m/d/Y', $info['birthday']), 'id="birthday"') ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">个性签名：</label>

            <div class="controls">
                <?=form_input('description', $info['description']) ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">学校：</label>

            <div class="controls">
                <?=form_dropdown('school', $schools, 'class="SelectWrapper"') ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">学校：</label>

            <div class="controls">
                <?=form_dropdown('province', $provinces, 'class="SelectWrapper"') ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <button type="submit" class="btn btn-info">保存</button>
                <button class="btn">取消</button>
            </div>
        </div>
        <?=form_close() ?>
        <script type="text/javascript">
            $("#birthday").datepicker({
                changeMonth: true,
                changeYear: true
            });
        </script>
    </ul>
</div>