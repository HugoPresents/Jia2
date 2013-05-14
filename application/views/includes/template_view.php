<? $this->load->view('includes/header_view') ?>
<? $this->load->view('includes/css_view') ?>
<? $this->load->view('includes/js_view') ?>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
<? if ($this->uri->segment(2) != 'login' && $this->uri->segment(2) != 'regist' && $this->session->userdata('type') != 'guest'): ?>
    <? $this->load->view('includes/nav_view') ?>
    <script type="text/javascript" src="<?= base_url('resource/js/notify.js') ?>"></script>
<? endif ?>
<div id="wrapper">
    <div id="Maincontent" class="clearfix">
        <div id="containerWrap">
            <? $this->load->view($main_content) ?>
        </div>
    </div>
</div>
<? $this->load->view('includes/footer_view') ?>
<div id="Top">
    <i class="icon_top" title="回到顶部"></i><br>
    Top
</div>
<a href="#popup1" data-toggle="modal" class="ico  ico_templete"></a>

<div id="popup1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <div id="myModalLabel">选择皮肤</div>
    </div>
    <div class="modal-body">
        <div class="templete_list">
            <a href="#">
                <img src="http://localhost:8088/data/skin/head_03_thumb.jpg" data=""/>
                <span>校园</span>
            </a>
            <a href="#">
                <img src="http://localhost:8088/data/skin/head_01_thumb.jpg" data=""/>
                <span>校园</span>
            </a>
            <a href="#">
                <img src="http://localhost:8088/data/skin/head_03_thumb.jpg" data=""/>
                <span>校园</span>
            </a>
            <a href="#">
                <img src="http://localhost:8088/data/skin/head_01_thumb.jpg" data=""/>
                <span>校园</span>
            </a>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal" aria-hidden="true">关闭</a>
        <a href="#" class="btn btn-warning" id="saveSkin" data-dismiss="modal" aria-hidden="true">保存</a>
    </div>
</div>
</body>
</html>
<script>
    $(function(){
        var bg_src = '',
            mainContainer = $(".mainContainer");
        $(".templete_list a").on("click",function(){
            var _this =  $(this);
            _this.siblings(".select").removeClass("select");
            _this.addClass("select");
            bg_src = _this.find("img").attr("src");
            bg_src =bg_src.replace("_thumb","");
            mainContainer.addClass("skin1");
            return false;
        });
    });

</script>