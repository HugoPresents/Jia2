<script type="text/javascript">
	//window.UEDITOR_HOME_URL = BASE_URL + 'resource/ueditor/';
	window.UEDITOR_SUBMIT_URL = SITE_URL +'blog/post';
	var UEDITOR_IMG_URL = "<?=$img_up ?>";
	var UEDITOR_IMG_PATH = "<?=$img_path ?>";
	var UEDITOR_IMG_MANAGER_URL = "<?=$img_manager ?>";
	var UEDITOR_GET_MOVIE = SITE_URL + 'blog/get_movie';
</script>
<script type="text/javascript" src="<?=base_url()?>resource/ueditor/editor_config.js"></script>
<script type="text/javascript" src="<?=base_url()?>resource/ueditor/editor_all.js"></script>
<link rel="stylesheet" href="<?=base_url();?>resource/ueditor/themes/default/ueditor.css"/>
<script type="text/plain" id="editor" name="myContent">
	<? if(isset($blog['content'])): ?>
		<?=$blog['content'] ?>
	<? endif ?>
</script>
<script type="text/javascript">
        var editor = new baidu.editor.ui.Editor();
        editor.render("editor");
</script>