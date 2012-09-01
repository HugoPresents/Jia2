<?=form_open('','class="write_letter_form"')?>
<?=form_button('letter', '写站内信','id="write_letter"') ?>
<span class="letter_message" style="display: none"></span>
<div id="write_letter_area" style="display:none">
	<li class="li_input"><label>收信人：</label>
		<div id="receiver"></div>
		<a href="#?w=500" rel="popup4" class="inline bold" id="check_linkman">选择收信人</a>
		<input type="hidden" name="receiver" id="receiver_id" />
	</li>
	<li ><label>內&nbsp;&nbsp;容：</label>
		<div class="mytextarea">
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
							<?=form_textarea(array('name' => 'content', 'id' => "letter_content")) ?>
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
		</table></div>
	</li>
	<li class="li_d"><?=form_button('submit', '发送', 'id="send_letter"') ?></li>
</div>
<?=form_close() ?>
<div class="letter_content">
			<div class="tab_title">
				<div class="s01" id="t_01">
					<a href="#" id="in_box">收件箱</a>
				</div>
				<div class="s02" id="t_02">
					<a href="#" id="out_box">发件箱</a>
				</div>
			</div>
			<div class="tab_content">
				<div id="letter_box" class="clear"></div>
			</div>
			
</div>
<div id="popup4" class="popup_block">
	<div id="linkman">		
			<a href="#" id="linkman0" class="sd01">我的关注</a>
			<a href="#" id="linkman1" class="sd02">我的粉丝</a>		
		</div>
		<ol class="slats" id="linkmanlist0">
		</ol>	
		<ol id="linkmanlist1" class="slats hidden">
		</ol>
		
		<div class="pagination pagination2" id="pagination0">
		</div>
		<div class="pagination pagination2 hidden" id="pagination1">
		</div>
	</div>
</div>