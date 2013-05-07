<div id="set_pass" class="tab-pane active">
    <h4 class="set_title">修改密码</h4>
    <ul id="pass_setting">
        <?=form_open('personal/do_setting', 'class="form-horizontal" id="pass"')?>
        <?=form_hidden('setting', 'pass') ?>
        <div class="control-group">
            <label class="control-label">原 密 码：</label>

            <div class="controls">
                <?=form_password('old_pass') ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">新 密 码：</label>

            <div class="controls">
                <?=form_password('pass') ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">确认密码：</label>

            <div class="controls">
                <?=form_password('pass_check') ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <button type="submit" id="pass_submit" class="btn btn-info">修改</button>
                <button class="btn">取消</button>
            </div>
        </div>
        <?=form_close() ?>
    </ul>
</div>