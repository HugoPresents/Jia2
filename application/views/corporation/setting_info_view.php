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
                        <? 
                        $corporation_tags = $this->config->item('corporation_tags');
                        foreach($tags as $tag): ?>
                            <span val="<?=$tag?>" class="tag-edit"><em></em><b><?=$corporation_tags[$tag]?></b><i></i></span>
                            <input type="hidden" value="<?=$tag?>" name="tags[]">
                        <? endforeach ?>
                    </div>
                    <h4 class="tag-title">添加符合自己的标签：</h4>
                    <div id="tag-animate-wrap" class="tag-wrap">
                        <? foreach($corporation_tags as $tag => $tagname):?>
                            <a val="<?=$tag?>" class="tag-default<?=in_array($tag, $tags) ? ' tag-pass':''?>"><em></em><span><?=$tagname?></span></a>
                        <? endforeach ?>
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
    $(".tag-default").on("click",function(){
        if($(this).hasClass("tag-pass")){
            return false;
        }else{
            var _this = $(this),
                tagname = _this.find("span").text(),
                tagval = _this.attr("val"),
                newtag = '';
            _this.addClass("tag-pass");
            newtag = '<span val="'+ tagval +'"class="tag-edit"><em></em><b>' + tagname +'</b><i></i></span>'+
                '<input type="hidden" value="' + tagval+ '" name="tags[]">';

            $(newtag).appendTo(".tag-now");
            return false;
        }


    });
    $(".tag-now").delegate("i","click",function(){
        var tagval = $(this).closest(".tag-edit").attr("val");
        $(this).closest(".tag-edit").next('input').remove();
        $(this).closest(".tag-edit").remove();
        
        $(".tag-pass").each(function(){
            if($(this).attr("val") == tagval){
                $(this).removeClass("tag-pass")
            }
        });
    });
</script>