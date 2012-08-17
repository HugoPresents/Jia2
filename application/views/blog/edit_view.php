<script>
$(function(){
	$(".Checked").toggle(function(){
			$(this).removeClass("Checked").addClass("Checkbox");
			$(this).children().removeAttr('checked');
		},function(){
			$(this).removeClass("Checkbox").addClass("Checked");
			$(this).children().attr("checked", "checked");
		})
	$(".Checkbox").toggle(function(){
			$(this).removeClass("Checkbox").addClass("Checked");
			$(this).children().attr("checked", "checked");
		},function(){
			$(this).removeClass("Checked").addClass("Checkbox");
			$(this).children().removeAttr('checked');
		})
})
</script> 
<h4 class="title_01 title_02"><span>编辑日志</span><?=$crumb ?></h4>
<div class="main_02">
	<div id="post_blog">
		<p><?=form_open() ?> </p>
	    <div id="blog_write">
			<div><label>标&nbsp;题：</label>
					<div class="InputWrapper"><div class="InputInner">
						<?=form_input('title', $blog['title']) ?>
					</div></div>
			</div>
			<div><label>标&nbsp;签：</label>
					<div class="InputWrapper"><div class="InputInner">
						<?=form_input('tags', $blog['tags']) ?>
					</div></div>
					<span class="info_notice">多个标签请用空格隔开</span>
			</div>
		</div>
		<?=$this->load->view('blog/editor') ?>
		<p class="li_d p_buttons">
			<?=anchor('blog', '取消', 'class="pub_button left"') ?>
			<?=form_submit('submit', '保存','class="btn-blue btn-pub-01 right"') ?>
			<?=form_submit('draft', '移到到草稿','class="pub_button btn-pub-02"') ?>
			
		</p>
	</div>
</div>
<div class="right_handler">
	<h4 class="set_title">日志选项</h4>
	<p>
		<span class="CheckboxWrapper Checked">
			<input type="checkbox" name="user" value="1" class="chbox" checked="checked"/>
		</span>
		<span class="Checkitem">置顶</span>
	</p><p>
		<span class="CheckboxWrapper Checkbox">
			<input type="checkbox" name="corporation" value="1" class="chbox"/>
		</span>
		<span class="Checkitem">设为社团历程</span>
	</p>
	<h4 class="set_title">可见性</h4>
	<p><label><?=form_radio(array('name' => 'status', 'value' => 'privary')) ?> 保密 (仅自己可见)</label></p>
	<p><label><?=form_radio(array('name' => 'status', 'value' => 'public', 'checked' => TRUE)) ?> 公开</label></p>
	<?=form_close() ?>
</div>