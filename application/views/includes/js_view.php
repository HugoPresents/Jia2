<? if(isset($js)): ?>
	<? if(is_array($js)): ?>
		<? foreach($js as $value): ?>
			<script type="text/javascript" src="<?=base_url('resource/js/' . $value) ?>"></script>
		<? endforeach; ?>
	<? else: ?>
	<script type="text/javascript" src="<?=base_url('resource/js/' . $js) ?>"></script>
	<? endif ?>
<? endif; ?>
</head>