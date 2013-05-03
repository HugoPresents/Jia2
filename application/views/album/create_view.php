<div class="mainContainer">
	<div class="container whiteBg">
		<h4 class="title_01 title_02"><span>相册</span><?=$crumb
		?></h4>
		<div class="main_03">
			<div id="add-album"  class="form-horizontal">
				<?=form_open('')
				?>
				<div class="control-group">
					<label class="control-label">相册名称：</label>
					<div class="controls">
						<?=form_input('name')
						?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">标签：</label>
					<div class="controls">
						<?=form_input('tags')
						?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">相册描述：</label>
					<div class="controls">
						<?=form_textarea('comment')
						?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">可见性：</label>
					<div class="controls">
						<?=form_radio(array('name' => 'status', 'value' => 'privary'))
						?>
						保密 (仅自己可见) <?=form_radio(array('name' => 'status', 'value' => 'public', 'checked' => TRUE))
						?>
						公开
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<?=anchor('album', '取消', 'class="btn"')
						?>
						<?=form_submit('submit', '保存','class="btn btn-info"')
						?>
					</div>
				</div>
				<?=form_close()
				?>
			</div>
		</div>
	</div>
</div>