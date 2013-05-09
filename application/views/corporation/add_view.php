<div id="main">
<div id="add-corporation">
			<?=form_open('','class="form"')?>
				<span ><label>社团名字：</label>
					<div class="InputWrapper">
					<div class="InputInner">
					   <?=form_input('', $co_name, 'disabled="disabled"') ?>
					</div>
					</div>
				</span>
				<span ><label>所属学校：</label>
					<?=form_input('', $school, 'disabled="disabled"') ?>
				</span>
				<span ><label>社长：</label>
					<div class="InputWrapper">
					<div class="InputInner">
							<?=form_input('', $user['name'], 'disabled="disabled"') ?>
					</div>
					</div>
				</span>
				<span ><label>社团简介：</label>
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
									<?=form_textarea(array('name' => 'comment')) ?>
								</div>
							</td>
							<td id="Textarea-mr"></td>
						</tr>
						<tr>
							<td id="Textarea-bl"></td>
							<td id="Textarea-bm"></td>
							<td id="Textarea-br"></td>
						</tr>
					</tbody>
					</table>
				</span>
				<p class="li_d"><?=form_submit('submit', '保存','class="pub_button"') ?></p>
			<?=form_close() ?>
	
</div>  
</div>