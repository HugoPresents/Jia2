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
</div>
<? $this->load->view('includes/footer_view') ?>
</div>
</body>
</html>