<div id="set_privacy" class="tab-pane active">
    <h4 class="set_title">隐私设置</h4>
    <ul id="pass_setting">
        <?=form_open('personal/do_setting', 'class="form-horizontal"')?>
        <?=form_hidden('setting', 'privacy') ?>
        <div class="control-group">
            <label class="control-label" for="inputEmail">浏览权限：</label>

            <div class="controls">
                <?=form_dropdown('post', array('guest' => '所有人&nbsp;', 'register' => '注册用户', 'follower' => '仅粉丝', 'self' => '仅自己'), $privacy['post'], 'class="SelectWrapper"') ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">评论权限：</label>

            <div class="controls">
                <?=form_dropdown('comment', array('register' => '注册用户&nbsp;', 'follower' => '仅粉丝', 'self' => '仅自己'), $privacy['comment'], 'class="SelectWrapper"') ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <button type="submit" class="btn btn-info">更新</button>
                <button class="btn">取消</button>
            </div>
        </div>
        <?=form_close() ?>
    </ul>
</div>