<? $this->load->view('includes/header_view') ?>
<? $this->load->view('includes/css_view') ?>
<? $this->load->view('includes/js_view') ?>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
<? if ($this->uri->segment(2) != 'login' && $this->uri->segment(2) != 'regist'): ?>
    <? $this->load->view('includes/nav_view') ?>
    <!--<script type="text/javascript" src="<?= base_url('resource/js/notify.js') ?>"></script>-->
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
    <i class="ico icon_top" title="回到顶部"></i><br>
    Top
</div>
<script type="text/javascript" src="<?=base_url('resource/js/new/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('resource/js/global.min.js') ?>"></script>

		<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-33951432-1']);
		_gaq.push(['_trackPageview']);
		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
        function onImgError(img){
            var noImgSrc;
            noImgSrc=BASE_URL+"data/avatar/personal/tiny/default.jpg";
            img.src = noImgSrc;
            img.onerror = null;
        }
		</script>

</body>
</html>
