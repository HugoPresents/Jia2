<? if(isset($css)): ?>
	<? if(is_array($css)): ?>
		<? foreach($css as $value): ?>
			<link rel="stylesheet" type="text/css" href="<?=base_url('resource/css/' . $value) ?>" />
		<? endforeach; ?>
	<? else: ?>
	<link rel="stylesheet" type="text/css" href="<?=base_url('resource/css/' . $css) ?>" />
	<? endif ?>
<? endif ?>