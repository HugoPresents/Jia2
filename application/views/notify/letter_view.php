<?=form_open('','class="write_letter_form form-horizontal"')?>
<?=form_button('letter', '写站内信','class="btn" id="write_letter"') ?>
<span class="letter_message" style="display: none"></span>
<div id="write_letter_area" style="display:none">
	<div class="control-group">
			    <label class="control-label">收信人：</label>
			    <div class="controls">
			      <div id="receiver"></div>
		<a href="#?w=500" rel="popup4" class="inline bold" id="check_linkman">选择收信人</a>
		<input type="hidden" name="receiver" id="receiver_id" />
			    </div>
			  </div>
	 <div class="control-group">
			    <label class="control-label">內&nbsp;&nbsp;容：</label>
			    <div class="controls">
			      <?=form_textarea(array('name' => 'content', 'id' => "letter_content")) ?>
			    </div>
			  </div>
			  <div class="control-group">
			    <div class="controls">
			      <a href="###" class="btn btn-info" id="send_letter">发送</a>
			      <button class="btn">取消</button>
			    </div>
			  </div>
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
</div>
</div>