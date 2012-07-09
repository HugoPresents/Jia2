<h4 class="title_01 title_02"><span>创建相册</span><?=anchor(str_replace('/create', '', uri_string()), $info['name'] . '的相册') ?></h4>
<div class="main_02">
	<div id="add-album">
		<?=form_open('') ?>
		<div class="form_line"><label>相册名称：</label>
			<div class="InputWrapper">
				<div class="InputInner">
					<?=form_input('name')?>
				</div>
			</div> </div>
		<div class="form_line"><label>标签：</label>
		<div class="InputWrapper">
			<div class="InputInner">
				<?=form_input('tags')?>
			</div>
		</div> </div>
		<div class="form_line"><label>相册描述：</label>
			<table class="Textarea">
				<tbody>
					<tr>
						<td id="Textarea-tl"></td>
						<td id="Textarea-tm"></td>
						<td id="Textarea-tr"></td>
					</tr>
					<tr>
						<td id="Textarea-ml"></td>
						<td id="Textarea-mm" class="">
						<div>
							<?=form_textarea('comment')?>
						</div></td>
						<td id="Textarea-mr"></td>
					</tr>
					<tr>
						<td id="Textarea-bl"></td>
						<td id="Textarea-bm"></td>
						<td id="Textarea-br"></td>
					</tr>
				</tbody>
			</table> </div>
			<div class="form_line"><label>可见性：</label>
				<p><span> <?=form_radio(array('name' => 'status', 'value' => 'privary')) ?> 保密 (仅自己可见)</span>
				<?=form_radio(array('name' => 'status', 'value' => 'public', 'checked' => TRUE)) ?> 公开</p>
			</div>
		<p>
			<?=anchor('album', '取消', 'class="pub_button"') ?>
			<?=form_submit('submit', '保存','class="pub_button"')?>
		</p>
		<?=form_close()?>
	</div>
</div>