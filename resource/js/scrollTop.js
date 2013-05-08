///*回?部*/
//$(function() {
//    $.fn.manhuatoTop = function(options) {
//        var defaults = {
//            showHeight : 150,
//            speed : 1000
//        };
//        var options = $.extend(defaults,options);
////        $("body").prepend("<div id='Top'><a href='javascript:void(0);' id='returnTop'><i class='icon_top' ></i><br>Top</a></div>");
//        var $toTop = $(this);
//        var $top = $("#Top");
//        var $ta = $("#returnTop");
//        $toTop.scroll(function(){
//            var scrolltop=$(this).scrollTop();
//            if(scrolltop>=options.showHeight){
//                $top.show();
//            }
//            else{
//                $top.hide();
//            }
//        });
//        $ta.hover(function(){
////            $(this).addClass("cur");
//        },function(){
////            $(this).removeClass("cur");
//        });
//        $top.click(function(){
//            $("html,body").animate({scrollTop: 0}, options.speed);
//        });
//    }
////    $(window).manhuatoTop({
////        showHeight:$(window).height()
////    });
//});
$(document).ready(function() {
    $(window).scroll(function() {
        if ($(this).scrollTop() > $(window).height()) {
            $("#Top").show();
        }
        else { $("#Top").hide(); }
    });
    $("#Top").click(function() {
        $("html,body").animate({ scrollTop: 0 }, "slow");
    });
});

