<? $this->load->view('notify/menu_view') ?>
<script type="text/javascript">
	NOTIFY_NOW = "<?=$notify ?>";
</script>
<? $this->load->view('notify/' . $notify . '_view') ?>
