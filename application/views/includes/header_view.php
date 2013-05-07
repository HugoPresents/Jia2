<!DOCTYPE html>
<html lang="en">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <META HTTP-EQUIV="pragma" CONTENT="no-cache">
        <title><?=(empty($title) ? '未定义标题' : $title) . ' | 加加社团' ?></title>
<!--         <link rel="stylesheet" type="text/css" href="<?=base_url('resource/css/home.css') ?>" /> -->
<!--         <link rel="stylesheet" type="text/css" href="<?=base_url('resource/css/main_content.css') ?>" /> -->
        <link rel="stylesheet" type="text/css" href="<?=base_url('resource/css/new/bootstrap.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?=base_url('resource/css/all.css') ?>" />
	    <script type="text/javascript" src="<?=base_url('resource/js/jquery.js') ?>"></script>
	    <script type="text/javascript" src="<?=base_url('resource/js/global.js') ?>"></script>
<!-- 	    <script type="text/javascript" src="<?=base_url('resource/js/tab.js') ?>"></script> -->
	    <script type="text/javascript" src="<?=base_url('resource/js/inline_window.js') ?>"></script>
	    <script type="text/javascript" src="<?=base_url('resource/js/new/bootstrap.min.js') ?>"></script>
		<script type="text/javascript">
        	SITE_URL = "<?=site_url() ?>";
        	BASE_URL = "<?=base_url()?>";
        </script>
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
<!--            noImgSrc=--><?//=avatar_url($corporation['avatar'], 'corporation', 'big')?><!--;-->
            noImgSrc="http://localhost:8088/data/avatar/personal/tiny/default.jpg";
            img.src = noImgSrc;
            img.onerror = null;
        }
		</script>