<div id="account" class="tab-pane active">
    <h4 class="set_title"><span><?=$info['name'] ?></span>，你好！</h4>
    <ul id="user_info">
        <form class="form form-horizontal">
            <div class="control-group">
                <label class="control-label" for="inputEmail">协会名称：</label>
                <div class="controls">
                    <?=form_input('name', $info['name']) ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputEmail">所在学校：</label>
                <div class="controls">
                    <?=form_input('name', $info['school'][0]['name']) ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputEmail">协会简介：</label>
                <div class="controls">
                    <?=form_textarea(array('name' => 'comment', 'value' => $info['comment'], 'style'=>'width: 410px; height: 175px;')) ?>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <?=form_hidden('setting', 'info') ?>
                    <button type="submit" class="btn btn-info">保存</button>
                    <button class="btn">取消</button>
                </div>
            </div>
        </form>
    </ul>
</div>