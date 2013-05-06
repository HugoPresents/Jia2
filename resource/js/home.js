jQuery.extend({
    /**
     * 清除当前选择内容
     */
    unselectContents:function () {
        if (window.getSelection)
            window.getSelection().removeAllRanges();
        else if (document.selection)
            document.selection.empty();
    }
});
jQuery.fn.extend({
    //获取光标的位置
    getRelated:function () {
        var editOBJ = $(this)[0];
        var CaretPos = 0, Sel = null;
        if (window.getSelection) {
            Sel = window.getSelection();
        } else if (document.getSelection) {
            Sel = document.getSelection();
        } else if (document.selection) {
            Sel = document.selection.createRange();
        }
        if (document.selection) {// IE Support
            var Sel2 = Sel.duplicate();
            Sel2.moveToElementText(editOBJ);
            var CaretPos = -1;
            for (CaretPos = 0; Sel2.compareEndPoints('StartToEnd', Sel) < 0; CaretPos++) {
                Sel2.moveStart('character', 1);
            }
        } else {
            CaretPos = 0;
            if (editOBJ.selectionStart || editOBJ.selectionStart == '0') { // Firefox support
                CaretPos = editOBJ.selectionStart;
            }
        }
        return CaretPos;
    }, moveCursor:function (index) {
        var obj = $(this)[0];
        if (document.selection) {
            var sel = obj.createTextRange();
            sel.moveStart('character', index);
            sel.collapse();
            sel.select();
        } else if (typeof obj.selectionStart == 'number' && typeof obj.selectionEnd == 'number') {
            obj.selectionStart = obj.selectionEnd = index;
        }
    },
    /**
     * 选中内容
     */
    selectContents:function () {
        $(this).each(function (i) {
            var node = this;
            var selection, range, doc, win;
            if ((doc = node.ownerDocument) &&
                (win = doc.defaultView) &&
                typeof win.getSelection != 'undefined' &&
                typeof doc.createRange != 'undefined' &&
                (selection = window.getSelection()) &&
                typeof selection.removeAllRanges != 'undefined') {
                range = doc.createRange();
                range.selectNode(node);
                if (i == 0) {
                    selection.removeAllRanges();
                }
                selection.addRange(range);
            }
            else if (document.body &&
                typeof document.body.createTextRange != 'undefined' &&
                (range = document.body.createTextRange())) {
                range.moveToElementText(node);
                range.select();
            }
        });
    },
    /**
     * 初始化对象以支持光标处插入内容
     */
    setCaret:function () {
        if (!$.browser.msie) return;
        var initSetCaret = function () {
            var textObj = $(this).get(0);
            textObj.caretPos = document.selection.createRange().duplicate();
        };
        $(this)
            .click(initSetCaret)
            .select(initSetCaret)
            .keyup(initSetCaret);
    },
    /**
     * 在当前对象光标处插入指定的内容
     */
    insertAtCaret:function (textFeildValue,index, callback) {
        var textObj = $(this).get(0);
        textObj.focus();
        if (document.selection) {
            $(this).moveCursor(index);
            var sel = document.selection.createRange();
            sel.text = textFeildValue;
        } else if (typeof textObj.selectionStart === 'number' && typeof textObj.selectionEnd === 'number') {
            var startPos = textObj.selectionStart,
                endPos = textObj.selectionEnd,
                cursorPos = startPos,
                tmpStr = textObj.value;
            textObj.value = tmpStr.substring(0, startPos) + textFeildValue + tmpStr.substring(endPos, tmpStr.length);
            cursorPos += textFeildValue.length;
            textObj.selectionStart = textObj.selectionEnd = cursorPos;
        } else {
            textObj.value += textFeildValue;
        }
        callback.call(textObj);
    }
});
$(function(){
    var textInput = $('#post_content'),cursorIndex = 0, allowTextLength = 140;

    var emotionArray = {'[微笑]':'0.gif', '[撇嘴]':'1.gif', '[色]':'2.gif', '[发呆]':'3.gif', '[得意]':'4.gif', '[流泪]':'5.gif', '[害羞]':'6.gif', '[闭嘴]':'7.gif', '[睡]':'8.gif', '[大哭]':'9.gif', '[尴尬]':'10.gif', '[发怒]':'11.gif', '[调皮]':'12.gif', '[龇牙]':'13.gif', '[惊讶]':'14.gif', '[难过]':'15.gif', '[酷]':'16.gif', '[冷汗]':'17.gif', '[抓狂]':'18.gif', '[吐]':'19.gif', '[偷笑]':'20.gif', '[可爱]':'21.gif', '[白眼]':'22.gif', '[傲慢]':'23.gif', '[饥饿]':'24.gif', '[困]':'25.gif', '[惊恐]':'26.gif', '[流汗]':'27.gif', '[憨笑]':'28.gif', '[大兵]':'29.gif', '[奋斗]':'30.gif', '[咒骂]':'31.gif', '[疑问]':'32.gif', '[嘘]':'33.gif', '[晕]':'34.gif', '[折磨]':'35.gif', '[衰]':'36.gif', '[骷髅]':'37.gif', '[敲打]':'38.gif', '[再见]':'39.gif', '[擦汗]':'40.gif', '[抠鼻]':'41.gif', '[鼓掌]':'42.gif', '[糗大了]':'43.gif', '[坏笑]':'44.gif', '[左哼哼]':'45.gif', '[右哼哼]':'46.gif', '[哈欠]':'47.gif', '[鄙视]':'48.gif', '[委屈]':'49.gif', '[快哭了]':'50.gif', '[阴险]':'51.gif', '[亲亲]':'52.gif', '[吓]':'53.gif', '[可怜]':'54.gif', '[菜刀]':'55.gif', '[西瓜]':'56.gif', '[啤酒]':'57.gif', '[篮球]':'58.gif', '[乒乓]':'59.gif', '[咖啡]':'60.gif', '[饭]':'61.gif', '[猪头]':'62.gif', '[玫瑰]':'63.gif', '[凋谢]':'64.gif', '[示爱]':'65.gif', '[爱心]':'66.gif', '[心碎]':'67.gif', '[蛋糕]':'68.gif', '[闪电]':'69.gif', '[炸弹]':'70.gif', '[刀]':'71.gif', '[足球]':'72.gif', '[瓢虫]':'73.gif', '[便便]':'74.gif', '[月亮]':'75.gif', '[太阳]':'76.gif', '[礼物]':'77.gif', '[拥抱]':'78.gif', '[强]':'79.gif', '[弱]':'80.gif', '[握手]':'81.gif', '[胜利]':'82.gif', '[抱拳]':'83.gif', '[勾引]':'84.gif', '[拳头]':'85.gif', '[差劲]':'86.gif', '[爱你]':'87.gif', '[NO]':'88.gif', '[OK]':'89.gif'};

    textInput.bind('click keyup',function(){
        cursorIndex=textInput.getRelated();
    });
    /*输入框管理*/
    textInput.bind('keyup change click focus',function (event) {
        var text = textInput.val();
        var textLength = text.length;
        if (textLength > allowTextLength) {
            textInput.val(text.substring(0, allowTextLength));
            $(".word_num").html(allowTextLength + "/" + allowTextLength);
            return false;
        }
        $(".word_num").html(textLength + "/" + allowTextLength);
    });

    $(".emot_btn").click(function (e) {
        e.cancelBubble = true;
        e.stopPropagation();
        var $this = $(this),
            emotion_bd = $('.emotion_bd');
        $(".emotion_wrap").removeClass("hide");
        if (emotion_bd.children().length === 0) {
            var emolist = '';
            $.each(emotionArray, function (key, val) {
                emolist += '<a href="javascript:;" title="' + key + '"></a>';
            });
            $(emolist).appendTo(".emotion_bd");
        }
        textInput.setCaret();                        
    });

    $(".emotion_bd").delegate("a", "click", function(){
        // $(".emotion_bd a").bind('click', function(){
        textInput.insertAtCaret(this.title,cursorIndex,function(){
            $(".emotion_wrap").addClass("hide");
            cursorIndex=textInput.getRelated();
        });
    });


    $(".emotion_wrap").click(function(e){
        e.cancelBubble = true;
        e.stopPropagation();
    });

    $(document).click(function(){
        if(!$(".emotion_wrap").hasClass("hide")){
            $(".emotion_wrap").addClass("hide");
        }
    });    
});

//ajax加载动态
$(function(){
    var switchTabs = $(".feed_switcher a"),
        loading = $(".loading"),
        countZan = "",
        feedul = $(".feedUl"),
        friend = $("#filter_friend"),
        asso =$("#filter_asso"),
        feedF = $("#feed_1"),
        feedA =$("#feed_2");
        
    //动态内容切换
    
//    //赞
//    $(".f_summary").delegate(".Zan","click",function(){
//        var _this = $(this), fid = _this.attr("fid"), userinfo = _this.attr("uid"),
//            zanNum = _this.children(".zanNum"), zannumber =zanNum.html(),
//            url = '/profile?_ajax_=zan';;
//
//        _this.attr('disabled',true);
//        $.ajax({
//            url:url,
//            dataType:'json',
//            type:'POST',
//            data:{
//                'feed_id':fid,
//                'userinfo':userinfo
//            },
//            success:function (data) {
//                if (data.error == 0) {
//                    zanNum.html(Number(zannumber) + 1);
//                } else if (data.error == -1) {
//                    //登陆
//                }
//                _this.removeAttr('disabled');
//                return false;
//            },
//            error:function () {
//                _this.removeAttr('disabled');
//                alert('网络错误！', 'error', 1500);
//            }
//        });
//        return false;
//
//
//    });
//    //转发
//    $(".f_summary").delegate(".Forward","click",function(){
//
//    });

    //评论
//    $(".f_summary").delegate(".CommetBtn","click",function(){
//        $(this).closest(".f_summary").siblings(".repeat").toggle();
//        return false
//    });
    $(".f_summary").delegate(".CommetBtn","toggle",function(){
        $(this).closest(".f_summary").siblings(".repeat").show();
        return false
    },function(){
        $(this).closest(".f_summary").siblings(".repeat").hide();
        return false
    });
});