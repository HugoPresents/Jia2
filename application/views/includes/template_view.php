<? $this->load->view('includes/header_view') ?>
<? $this->load->view('includes/css_view') ?>
<? $this->load->view('includes/js_view') ?>
<body>
<div id="wrapper">
<div id="content">
<? if($this->uri->segment(2) != 'login' && $this->uri->segment(2) != 'regist'): ?>
<? $this->load->view('includes/nav_view') ?>
<script type="text/javascript" src="<?=base_url('resource/js/notify.js') ?>"></script>
<? endif ?>
<div id="container">
<? $this->load->view($main_content) ?> 
</div>
<? $this->load->view('includes/footer_view') ?>
</div>
</div>
<div style="display:none;">
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fcd2534101c1e852506df52dc57449c20' type='text/javascript'%3E%3C/script%3E"));
</script>
</div>
</body>
</html>