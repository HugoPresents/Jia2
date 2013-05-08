<? $this->load->view('includes/header_view') ?>
<? $this->load->view('includes/css_view') ?>
<? $this->load->view('includes/js_view') ?>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
<? if ($this->uri->segment(2) != 'login' && $this->uri->segment(2) != 'regist'): ?>
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
</body>
</html>