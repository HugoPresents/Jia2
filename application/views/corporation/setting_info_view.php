<div id="account" class="tab-pane active">
    <h4 class="set_title"><span><?=$info['name'] ?></span>，你好！</h4>
    <ul id="user_info">
        <form class="form form-horizontal" method="post">
            <div class="control-group">
                <label class="control-label" for="inputEmail">协会名称：</label>
                <div class="controls">
                    <?=form_input('name', $info['name'], 'disabled="disabled"') ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputEmail">所在学校：</label>
                <div class="controls">
                    <?=form_input('name', $info['school'][0]['name'], 'disabled="disabled"') ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputEmail">协会简介：</label>
                <div class="controls">
                    <?=form_textarea(array('name' => 'comment', 'value' => $info['comment'], 'style'=>'width: 410px; height: 175px;')) ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputEmail">协会标签：</label>
                <div class="controls ">
                    <h4 class="tag-title">已添加：</h4>
                    <div class="tag-now">
<!--                        点击下面的标签后，这里会动态添加已选标签，并且把标签值存在 隐藏的input 里面，提交表单的时候方便提交-->
<!--                        <span val="2" class="tag-edit"><em></em><b>社会实践类</b><i></i></span>-->
<!--                        <input type="hidden" value="社会实践类" name="tagname">-->
                    </div>
                    <h4 class="tag-title">添加符合自己的标签：</h4>
                    <div id="tag-animate-wrap" class="tag-wrap">
                        <a val="1" class="tag-default"><em></em><span>理论学习类</span></a>
                        <a val="2" class="tag-default"><em></em><span>社会实践类</span></a>
                        <a val="3" class="tag-default"><em></em><span>文化艺术类</span></a>
                        <a val="4" class="tag-default"><em></em><span>兴趣爱好类</span></a>
                        <a val="5" class="tag-default"><em></em><span>学术科技类</span></a>
                        <a val="6" class="tag-default"><em></em><span>其他类</span></a>
                    </div>
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
<script type="text/javascript">
//    $(".tag-wrap").delegate(".tag_pass","click",function(e){
//        event.preventDefault();
//    });
    $(".tag-default").on("click",function(){
        var _this = $(this),
            tagname = _this.find("span").text(),
            tagval = _this.attr("val");
            newtag = '';

        _this.addClass("tag-pass");
        newtag = '<span val="'+ tagval +'"class="tag-edit"><em></em><b>' + tagname +'</b><i></i></span>'+
                 '<input type="hidden" value="' + tagname+ '" name="tagname">';

        $(newtag).appendTo(".tag-now");
        return false;
    });
    $(".tag-now").delegate("i","click",function(){
        var tagval = $(this).closest(".tag-edit").attr("val");
        $(this).closest(".tag-edit").remove();
        $(".tag-pass").each(function(){
            if($(this).attr("val") == tagval){
                $(this).removeClass("tag-pass")
            }
        });
    });
</script>